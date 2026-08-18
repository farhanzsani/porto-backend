<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::orderByDesc('created_at')->paginate(10);

        return view('admin.technologies.index', compact('technologies'));
    }

    public function create()
    {
        return view('admin.technologies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:255|unique:technologies,slug',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:20',
            'proficiency_level' => 'nullable|integer|min:0|max:100',
            'years_experience' => 'nullable|numeric|min:0|max:99.9',
            'is_featured' => 'boolean',
        ]);

        $technology = Technology::create([
            ...$validated,
            'slug' => $validated['slug'] ?? Str::slug($validated['name']),
            'is_featured' => $request->boolean('is_featured'),
            'proficiency_level' => $validated['proficiency_level'] ?? 50,
        ]);

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Technology created successfully.');
    }

    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    public function update(Request $request, Technology $technology)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:255|unique:technologies,slug,' . $technology->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:20',
            'proficiency_level' => 'nullable|integer|min:0|max:100',
            'years_experience' => 'nullable|numeric|min:0|max:99.9',
            'is_featured' => 'boolean',
        ]);

        $technology->update([
            ...$validated,
            'slug' => $validated['slug'] ?? Str::slug($validated['name']),
            'is_featured' => $request->boolean('is_featured'),
            'proficiency_level' => $validated['proficiency_level'] ?? 50,
        ]);

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Technology updated successfully.');
    }

    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Technology deleted successfully.');
    }
}