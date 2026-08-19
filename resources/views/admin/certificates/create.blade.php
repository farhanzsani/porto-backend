@extends('admin.layouts.app')

@section('title', 'Add Certificate')

@section('content')
    <div class="max-w-2xl">
        <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Certificate Details</h3>
                </div>
                <div class="space-y-5 p-5 sm:p-6">

                    {{-- Title --}}
                    <div>
                        <label for="title" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Title <span class="text-error-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="e.g. AWS Certified Developer" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        @error('title')<p class="mt-1 text-xs text-error-600 dark:text-error-400">{{ $message }}</p>@enderror
                    </div>

                    {{-- Issuing Organization --}}
                    <div>
                        <label for="issuing_organization" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Issuing Organization <span class="text-error-500">*</span></label>
                        <input type="text" name="issuing_organization" id="issuing_organization" value="{{ old('issuing_organization') }}" placeholder="e.g. Amazon Web Services" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        @error('issuing_organization')<p class="mt-1 text-xs text-error-600 dark:text-error-400">{{ $message }}</p>@enderror
                    </div>

                    {{-- Issue Date / Expiry Date --}}
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="issue_date" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Issue Date <span class="text-error-500">*</span></label>
                            <input type="date" name="issue_date" id="issue_date" value="{{ old('issue_date') }}" required
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                            @error('issue_date')<p class="mt-1 text-xs text-error-600 dark:text-error-400">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="expiry_date" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Expiry Date <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date') }}"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                            @error('expiry_date')<p class="mt-1 text-xs text-error-600 dark:text-error-400">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Credential ID / Credential URL --}}
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="credential_id" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Credential ID <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="text" name="credential_id" id="credential_id" value="{{ old('credential_id') }}" placeholder="e.g. ABC123XYZ"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            @error('credential_id')<p class="mt-1 text-xs text-error-600 dark:text-error-400">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="credential_url" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Credential URL <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="url" name="credential_url" id="credential_url" value="{{ old('credential_url') }}" placeholder="https://..."
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            @error('credential_url')<p class="mt-1 text-xs text-error-600 dark:text-error-400">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Certificate Image --}}
                    <div>
                        <label for="image" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Certificate Image <span class="text-gray-400 font-normal">(optional)</span></label>
                        <div class="flex items-center justify-center w-full">
                            <label for="image" class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:hover:bg-gray-800">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                                    <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="mb-1 text-sm text-gray-500 dark:text-gray-400"><span class="font-medium">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-400">PNG, JPG, GIF, WEBP up to 2MB</p>
                                </div>
                                <p class="hidden py-4 text-sm font-medium text-gray-700 dark:text-gray-300" id="file-name-display"></p>
                            </label>
                            <input type="file" name="image" id="image" accept="image/*" class="hidden">
                        </div>
                        @error('image')<p class="mt-1 text-xs text-error-600 dark:text-error-400">{{ $message }}</p>@enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Description <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="description" id="description" rows="3" placeholder="Brief description of the certificate..."
                            class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">{{ old('description') }}</textarea>
                        @error('description')<p class="mt-1 text-xs text-error-600 dark:text-error-400">{{ $message }}</p>@enderror
                    </div>

                    {{-- Active toggle --}}
                    <div class="flex items-center gap-3">
                        <label class="relative inline-flex cursor-pointer items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
                            <div class="peer h-5 w-9 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-4 after:w-4 after:rounded-full after:bg-white after:transition-all after:content-[''] peer-checked:bg-brand-500 peer-checked:after:translate-x-full dark:bg-gray-700"></div>
                        </label>
                        <label for="is_active" class="text-theme-sm font-medium text-gray-700 dark:text-gray-400 cursor-pointer">Active</label>
                    </div>

                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="rounded-lg bg-brand-500 px-5 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">Add Certificate</button>
                <a href="{{ route('admin.certificates.index') }}" class="text-theme-sm font-medium text-gray-700 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function () {
            const placeholder = document.getElementById('upload-placeholder');
            const nameDisplay = document.getElementById('file-name-display');
            if (this.files.length > 0) {
                placeholder.classList.add('hidden');
                nameDisplay.classList.remove('hidden');
                nameDisplay.textContent = this.files[0].name;
            } else {
                placeholder.classList.remove('hidden');
                nameDisplay.classList.add('hidden');
            }
        });
    </script>
@endsection

