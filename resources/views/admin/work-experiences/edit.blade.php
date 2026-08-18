@extends('admin.layouts.app')

@section('title', 'Edit Work Experience')

@section('content')
    <div class="max-w-2xl">
        <form action="{{ route('admin.work-experiences.update', $workExperience) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Job Details</h3>
                </div>
                <div class="grid grid-cols-1 gap-5 p-5 sm:p-6 md:grid-cols-2">
                    <div>
                        <label for="company_name" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Company Name</label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $workExperience->company_name) }}" required class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        @error('company_name')<p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="position" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Position</label>
                        <input type="text" name="position" id="position" value="{{ old('position', $workExperience->position) }}" required class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        @error('position')<p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="company_logo" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Company Logo</label>
                        @if ($workExperience->company_logo)
                            <img src="{{ $workExperience->company_logo }}" alt="{{ $workExperience->company_name }}" class="mb-3 h-16 w-16 rounded-lg border border-gray-200 object-cover dark:border-gray-800">
                        @endif
                        <input type="file" name="company_logo" id="company_logo" accept="image/*" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-500 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-brand-600 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:file:bg-brand-600">
                        @error('company_logo')<p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Description</label>
                        <textarea name="description" id="description" rows="4" required class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">{{ old('description', $workExperience->description) }}</textarea>
                        @error('description')<p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="company_url" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Company URL</label>
                        <input type="text" name="company_url" id="company_url" value="{{ old('company_url', $workExperience->company_url) }}" placeholder="https://..." class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>
                    <div>
                        <label for="location" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location', $workExperience->location) }}" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Employment</h3>
                </div>
                <div class="grid grid-cols-1 gap-5 p-5 sm:p-6 md:grid-cols-2">
                    <div>
                        <label for="employment_type" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Employment Type</label>
                        <select name="employment_type" id="employment_type" class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            <option value="full_time" {{ old('employment_type', $workExperience->employment_type) === 'full_time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part_time" {{ old('employment_type', $workExperience->employment_type) === 'part_time' ? 'selected' : '' }}>Part Time</option>
                            <option value="contract" {{ old('employment_type', $workExperience->employment_type) === 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="freelance" {{ old('employment_type', $workExperience->employment_type) === 'freelance' ? 'selected' : '' }}>Freelance</option>
                            <option value="internship" {{ old('employment_type', $workExperience->employment_type) === 'internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>

                    <div>
                        <label for="start_date" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $workExperience->start_date?->format('Y-m-d')) }}" required class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>
                    <div id="end-date-wrapper">
                        <label for="end_date" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $workExperience->end_date?->format('Y-m-d')) }}" @if($workExperience->is_current) disabled @endif class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>
                    <div class="flex items-end pb-1">
                        <label class="inline-flex cursor-pointer items-center gap-2">
                            <input type="checkbox" name="is_current" value="1" id="is_current" {{ old('is_current', $workExperience->is_current) ? 'checked' : '' }} class="size-5 rounded border-gray-300 text-brand-500 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900">
                            <span class="text-theme-sm font-medium text-gray-700 dark:text-gray-400">Currently working</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">Update Experience</button>
                <a href="{{ route('admin.work-experiences.index') }}" class="text-theme-sm font-medium text-gray-700 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90">Cancel</a>
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