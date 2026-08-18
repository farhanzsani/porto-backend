<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderByDesc('created_at')->paginate(10);

        return view('admin.educations.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.educations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'institution_name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'description' => 'nullable|string',
            'institution_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'institution_url' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'grade' => 'nullable|string|max:50',
        ]);

        $data = [
            ...$validated,
            'is_current' => $request->boolean('is_current'),
            'end_date' => $request->boolean('is_current') ? null : ($validated['end_date'] ?? null),
        ];

        if ($request->hasFile('institution_logo')) {
            $data['institution_logo'] = Storage::url($request->file('institution_logo')->store('educations', 'public'));
        }

        Education::create($data);

        return redirect()->route('admin.educations.index')
            ->with('success', 'Education created successfully.');
    }

    public function edit(Education $education)
    {
        return view('admin.educations.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'institution_name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'description' => 'nullable|string',
            'institution_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'institution_url' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'grade' => 'nullable|string|max:50',
        ]);

        $data = [
            ...$validated,
            'is_current' => $request->boolean('is_current'),
            'end_date' => $request->boolean('is_current') ? null : ($validated['end_date'] ?? null),
        ];

        if ($request->hasFile('institution_logo')) {
            $this->deleteStoredFile($education->institution_logo);
            $data['institution_logo'] = Storage::url($request->file('institution_logo')->store('educations', 'public'));
        }

        $education->update($data);

        return redirect()->route('admin.educations.index')
            ->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        $this->deleteStoredFile($education->institution_logo);
        $education->delete();

        return redirect()->route('admin.educations.index')
            ->with('success', 'Education deleted successfully.');
    }

    protected function deleteStoredFile(?string $url): void
    {
        if (!$url || !str_starts_with($url, '/storage/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($url, '/storage/'));
    }
}