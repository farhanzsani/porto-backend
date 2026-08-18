<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('technologies')->orderByDesc('created_at')->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $technologies = Technology::orderBy('name')->get();

        return view('admin.projects.create', compact('technologies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug',
            'description' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'client' => 'nullable|string|max:255',
            'project_url' => 'nullable|string|max:255',
            'github_url' => 'nullable|string|max:255',
            'technologies' => 'nullable|array',
            'technologies.*' => 'exists:technologies,id',
            'media' => 'nullable|array',
            'media.*.id' => 'nullable|integer|exists:project_media,id',
            'media.*.file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,webm,mov,pdf|max:10240',
            'media.*.file_path' => 'nullable|string|max:255',
            'media.*.file_type' => 'nullable|in:image,video,document',
            'media.*.title' => 'nullable|string|max:255',
        ]);

        $data = [
            ...$validated,
            'slug' => $validated['slug'] ?? Str::slug($validated['title']),
        ];

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = Storage::url($request->file('featured_image')->store('projects/featured', 'public'));
        }

        $project = Project::create($data);

        if (!empty($validated['technologies'])) {
            $project->technologies()->sync($validated['technologies']);
        }

        if (!empty($validated['media'])) {
            $this->syncMedia($project, $validated['media']);
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load(['media', 'technologies']);

        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $technologies = Technology::orderBy('name')->get();

        return view('admin.projects.edit', compact('project', 'technologies'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug,' . $project->id,
            'description' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'client' => 'nullable|string|max:255',
            'project_url' => 'nullable|string|max:255',
            'github_url' => 'nullable|string|max:255',
            'technologies' => 'nullable|array',
            'technologies.*' => 'exists:technologies,id',
            'media' => 'nullable|array',
            'media.*.id' => 'nullable|integer|exists:project_media,id',
            'media.*.file' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,webm,mov,pdf|max:10240',
            'media.*.file_path' => 'nullable|string|max:255',
            'media.*.file_type' => 'nullable|in:image,video,document',
            'media.*.title' => 'nullable|string|max:255',
        ]);

        $data = [
            ...$validated,
            'slug' => $validated['slug'] ?? Str::slug($validated['title']),
        ];

        if ($request->hasFile('featured_image')) {
            $this->deleteStoredFile($project->featured_image);
            $data['featured_image'] = Storage::url($request->file('featured_image')->store('projects/featured', 'public'));
        }

        $project->update($data);

        if (array_key_exists('technologies', $validated)) {
            $project->technologies()->sync($validated['technologies']);
        }

        if (array_key_exists('media', $validated)) {
            $this->syncMedia($project, $validated['media']);
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    protected function syncMedia(Project $project, array $media): void
    {
        $submittedIds = collect($media)->pluck('id')->filter()->map(fn ($id) => (int) $id)->all();

        $project->media()
            ->whereNotIn('id', $submittedIds ?: [0])
            ->get()
            ->each(function ($item) {
                $this->deleteStoredFile($item->file_path);
                $item->delete();
            });

        foreach ($media as $item) {
            $file = $item['file'] ?? null;

            if (!empty($item['id'])) {
                $mediaItem = $project->media()->find($item['id']);
                if (!$mediaItem) {
                    continue;
                }

                $mediaItem->update([
                    'file_type' => $item['file_type'] ?? $mediaItem->file_type,
                    'title' => $item['title'] ?? $mediaItem->title,
                ]);

                if ($file) {
                    $this->deleteStoredFile($mediaItem->file_path);
                    $path = $file->store('projects/media', 'public');
                    $mediaItem->update([
                        'file_path' => Storage::url($path),
                        'mime_type' => $this->detectMimeType($path),
                        'file_type' => $item['file_type'] ?? $this->detectFileType($path),
                    ]);
                }
                continue;
            }

            if (!$file && empty($item['file_path'])) {
                continue;
            }

            $path = $file ? $file->store('projects/media', 'public') : $item['file_path'];
            $mimeType = $this->detectMimeType($path);

            $project->media()->create([
                'file_path' => $file ? Storage::url($path) : $path,
                'file_type' => $item['file_type'] ?? $this->detectFileType($path),
                'mime_type' => $mimeType,
                'title' => $item['title'] ?? null,
            ]);
        }
    }

    protected function detectMimeType(string $path): string
    {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return match ($extension) {
            'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg' => 'image/' . $extension,
            'mp4', 'webm', 'mov' => 'video/' . $extension,
            'pdf' => 'application/pdf',
            default => 'application/octet-stream',
        };
    }

    protected function detectFileType(string $path): string
    {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return match ($extension) {
            'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg' => 'image',
            'mp4', 'webm', 'mov' => 'video',
            default => 'document',
        };
    }

    protected function deleteStoredFile(?string $url): void
    {
        if (!$url || !str_starts_with($url, '/storage/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($url, '/storage/'));
    }

    public function destroy(Project $project)
    {
        $this->deleteStoredFile($project->featured_image);

        foreach ($project->media as $item) {
            $this->deleteStoredFile($item->file_path);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}