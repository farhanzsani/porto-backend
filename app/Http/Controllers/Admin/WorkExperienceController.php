<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WorkExperienceController extends Controller
{
    public function index()
    {
        $experiences = WorkExperience::orderByDesc('created_at')->paginate(10);

        return view('admin.work-experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.work-experiences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'company_url' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'required|in:full_time,part_time,contract,freelance,internship',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
        ]);

        $data = [
            ...$validated,
            'is_current' => $request->boolean('is_current'),
            'end_date' => $request->boolean('is_current') ? null : ($validated['end_date'] ?? null),
        ];

        if ($request->hasFile('company_logo')) {
            $data['company_logo'] = Storage::url($request->file('company_logo')->store('work-experiences', 'public'));
        }

        WorkExperience::create($data);

        return redirect()->route('admin.work-experiences.index')
            ->with('success', 'Work experience created successfully.');
    }

    public function edit(WorkExperience $workExperience)
    {
        return view('admin.work-experiences.edit', compact('workExperience'));
    }

    public function update(Request $request, WorkExperience $workExperience)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'company_url' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'required|in:full_time,part_time,contract,freelance,internship',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
        ]);

        $data = [
            ...$validated,
            'is_current' => $request->boolean('is_current'),
            'end_date' => $request->boolean('is_current') ? null : ($validated['end_date'] ?? null),
        ];

        if ($request->hasFile('company_logo')) {
            $this->deleteStoredFile($workExperience->company_logo);
            $data['company_logo'] = Storage::url($request->file('company_logo')->store('work-experiences', 'public'));
        }

        $workExperience->update($data);

        return redirect()->route('admin.work-experiences.index')
            ->with('success', 'Work experience updated successfully.');
    }

    public function destroy(WorkExperience $workExperience)
    {
        $this->deleteStoredFile($workExperience->company_logo);
        $workExperience->delete();

        return redirect()->route('admin.work-experiences.index')
            ->with('success', 'Work experience deleted successfully.');
    }

    protected function deleteStoredFile(?string $url): void
    {
        if (!$url || !str_starts_with($url, '/storage/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($url, '/storage/'));
    }
}