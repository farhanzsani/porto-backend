@extends('admin.layouts.app')

@section('title', 'Edit Technology')

@section('content')
    <div class="max-w-2xl">
        <form action="{{ route('admin.technologies.update', $technology) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Technology Details</h3>
                </div>
                <div class="grid grid-cols-1 gap-5 p-5 sm:p-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $technology->name) }}" required class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        @error('name')
                            <p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $technology->slug) }}" placeholder="auto-generated if empty" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Description</label>
                        <textarea name="description" id="description" rows="3" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">{{ old('description', $technology->description) }}</textarea>
                    </div>

                    <div>
                        <label for="icon" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Icon</label>
                        <input type="text" name="icon" id="icon" value="{{ old('icon', $technology->icon) }}" placeholder="devicon-laravel-plain" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>

                    <div>
                        <label for="color" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Color (hex)</label>
                        <input type="text" name="color" id="color" value="{{ old('color', $technology->color) }}" placeholder="#FF2D20" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Skill Level</h3>
                </div>
                <div class="grid grid-cols-1 gap-5 p-5 sm:p-6 md:grid-cols-2">
                    <div>
                        <label for="proficiency_level" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Proficiency (0-100)</label>
                        <input type="number" name="proficiency_level" id="proficiency_level" value="{{ old('proficiency_level', $technology->proficiency_level) }}" min="0" max="100" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>

                    <div>
                        <label for="years_experience" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Years Experience</label>
                        <input type="number" name="years_experience" id="years_experience" value="{{ old('years_experience', $technology->years_experience) }}" step="0.1" min="0" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>

                    <div class="flex items-end pb-1">
                        <label class="inline-flex cursor-pointer items-center gap-2">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $technology->is_featured) ? 'checked' : '' }} class="size-5 rounded border-gray-300 text-brand-500 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900">
                            <span class="text-theme-sm font-medium text-gray-700 dark:text-gray-400">Featured technology</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">
                    Update Technology
                </button>
                <a href="{{ route('admin.technologies.index') }}" class="text-theme-sm font-medium text-gray-700 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90">Cancel</a>
            </div>
        </form>
    </div>
@endsection