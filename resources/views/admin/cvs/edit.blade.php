@extends('admin.layouts.app')

@section('title', 'Edit CV')

@section('content')
    <div class="max-w-2xl">
        <form action="{{ route('admin.cvs.update', $cv) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Edit CV</h3>
                </div>
                <div class="space-y-5 p-5 sm:p-6">
                    <div>
                        <label for="title" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $cv->title) }}" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        @error('title')<p class="mt-1 text-xs text-error-600 dark:text-error-400">{{ $message }}</p>@enderror
                    </div>

                    {{-- Current file info --}}
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800/50">
                        <p class="mb-1 text-theme-xs font-medium text-gray-500 uppercase dark:text-gray-400">Current File</p>
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-2">
                                <svg class="text-gray-400 shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                                </svg>
                                <span class="text-theme-sm text-gray-700 dark:text-gray-300">{{ $cv->original_filename }}</span>
                                <span class="text-theme-xs text-gray-400 dark:text-gray-500">({{ $cv->file_size_formatted }})</span>
                            </div>
                            <a href="{{ Storage::url($cv->file_path) }}" target="_blank" class="text-theme-xs font-medium text-brand-600 hover:underline dark:text-brand-400">Preview</a>
                        </div>
                    </div>

                    <div>
                        <label for="file" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Replace File <span class="font-normal text-gray-400">(optional)</span></label>
                        <div class="flex items-center justify-center w-full">
                            <label for="file" class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:hover:bg-gray-800">
                                <div class="flex flex-col items-center justify-center pt-4 pb-4" id="upload-placeholder">
                                    <svg class="w-6 h-6 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-medium">Click to upload</span> a new file</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500">PDF, DOC, DOCX (max 10 MB)</p>
                                </div>
                                <p class="hidden pb-4 text-sm font-medium text-brand-600 dark:text-brand-400" id="file-name-display"></p>
                            </label>
                            <input id="file" name="file" type="file" class="hidden" accept=".pdf,.doc,.docx" />
                        </div>
                        @error('file')<p class="mt-1 text-xs text-error-600 dark:text-error-400">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <label class="relative inline-flex cursor-pointer items-center" for="is_active">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $cv->is_active) ? 'checked' : '' }} class="peer sr-only">
                            <div class="peer h-5 w-9 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-4 after:w-4 after:rounded-full after:bg-white after:transition-all peer-checked:bg-brand-500 peer-checked:after:translate-x-full dark:bg-gray-700"></div>
                            <span class="ml-3 text-theme-sm font-medium text-gray-700 dark:text-gray-400">Active (visible for download)</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">Save Changes</button>
                <a href="{{ route('admin.cvs.index') }}" class="text-theme-sm font-medium text-gray-700 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('file').addEventListener('change', function () {
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
