@extends('admin.layouts.app')

@section('title', 'Create Education')

@section('content')
    <div class="max-w-2xl">
        <form action="{{ route('admin.educations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Education Details</h3>
                </div>
                <div class="grid grid-cols-1 gap-5 p-5 sm:p-6 md:grid-cols-2">
                    <div>
                        <label for="institution_name" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Institution Name</label>
                        <input type="text" name="institution_name" id="institution_name" value="{{ old('institution_name') }}" required class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        @error('institution_name')<p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="degree" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Degree</label>
                        <input type="text" name="degree" id="degree" value="{{ old('degree') }}" placeholder="Bachelor of Science" required class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        @error('degree')<p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="field_of_study" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Field of Study</label>
                        <input type="text" name="field_of_study" id="field_of_study" value="{{ old('field_of_study') }}" placeholder="Computer Science" required class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        @error('field_of_study')<p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="grade" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Grade / GPA</label>
                        <input type="text" name="grade" id="grade" value="{{ old('grade') }}" placeholder="3.8 GPA" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>

                    <div class="md:col-span-2">
                        <label for="institution_logo" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Institution Logo</label>
                        <input type="file" name="institution_logo" id="institution_logo" accept="image/*" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-500 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-brand-600 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:file:bg-brand-600">
                        @error('institution_logo')<p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Description</label>
                        <textarea name="description" id="description" rows="4" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="institution_url" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Institution URL</label>
                        <input type="text" name="institution_url" id="institution_url" value="{{ old('institution_url') }}" placeholder="https://..." class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>
                    <div>
                        <label for="location" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Period</h3>
                </div>
                <div class="grid grid-cols-1 gap-5 p-5 sm:p-6 md:grid-cols-3">
                    <div>
                        <label for="start_date" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>
                    <div>
                        <label for="end_date" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>
                    <div class="flex items-end pb-1">
                        <label class="inline-flex cursor-pointer items-center gap-2">
                            <input type="checkbox" name="is_current" value="1" id="is_current" {{ old('is_current') ? 'checked' : '' }} class="size-5 rounded border-gray-300 text-brand-500 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900">
                            <span class="text-theme-sm font-medium text-gray-700 dark:text-gray-400">Currently studying</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">Create Education</button>
                <a href="{{ route('admin.educations.index') }}" class="text-theme-sm font-medium text-gray-700 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('is_current').addEventListener('change', function() {
            document.getElementById('end_date').disabled = this.checked;
            if (this.checked) document.getElementById('end_date').value = '';
        });
    </script>
@endsection