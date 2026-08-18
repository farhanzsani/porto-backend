@extends('admin.layouts.app')

@section('title', 'Edit Project')

@section('content')
    <div class="max-w-3xl">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Project Details</h3>
                </div>
                <div class="grid grid-cols-1 gap-5 p-5 sm:p-6 md:grid-cols-2">
                    <div>
                        <label for="title" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" required class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        @error('title')
                            <p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $project->slug) }}" placeholder="auto-generated if empty" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                        @error('slug')
                            <p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Description</label>
                        <textarea name="description" id="description" rows="3" required class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="content" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Content</label>
                        <textarea name="content" id="content" rows="10" required class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 font-mono text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">{{ old('content', $project->content) }}</textarea>
                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Supports HTML</p>
                        @error('content')
                            <p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="featured_image" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Featured Image</label>
                        @if ($project->featured_image)
                            <img src="{{ $project->featured_image }}" alt="{{ $project->title }}" class="mb-3 h-32 w-full rounded-lg border border-gray-200 object-cover dark:border-gray-800">
                        @endif
                        <input type="file" name="featured_image" id="featured_image" accept="image/*" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-500 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-brand-600 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:file:bg-brand-600">
                        @error('featured_image')
                            <p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="client" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Client</label>
                        <input type="text" name="client" id="client" value="{{ old('client', $project->client) }}" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>

                    <div>
                        <label for="project_url" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Project URL</label>
                        <input type="text" name="project_url" id="project_url" value="{{ old('project_url', $project->project_url) }}" placeholder="https://..." class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>

                    <div>
                        <label for="github_url" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">GitHub URL</label>
                        <input type="text" name="github_url" id="github_url" value="{{ old('github_url', $project->github_url) }}" placeholder="https://github.com/..." class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Technologies</h3>
                </div>
                <div class="grid grid-cols-2 gap-2 p-5 sm:p-6 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($technologies as $technology)
                        <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 p-2.5 hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-white/[0.03]">
                            <input type="checkbox" name="technologies[]" value="{{ $technology->id }}" {{ in_array($technology->id, old('technologies', $project->technologies->pluck('id')->toArray())) ? 'checked' : '' }} class="size-4 rounded border-gray-300 text-brand-500 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900">
                            <span class="text-sm text-gray-700 dark:text-gray-400">{{ $technology->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Media Gallery</h3>
                    <button type="button" id="add-media" class="text-theme-sm font-medium text-brand-500 hover:text-brand-600 dark:text-brand-400">+ Add Media</button>
                </div>
                <div id="media-container" class="space-y-3 p-5 sm:p-6">
                    @foreach ($project->media as $media)
                        <div class="media-row grid grid-cols-1 gap-3 rounded-lg bg-gray-50 p-3 dark:bg-white/[0.03] md:grid-cols-4">
                            <input type="hidden" name="media[{{ $loop->index }}][id]" value="{{ $media->id }}">
                            <div>
                                <input type="file" name="media[{{ $loop->index }}][file]" class="w-full rounded-lg border border-gray-300 bg-transparent px-3 py-2.5 text-sm text-gray-800 shadow-theme-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-500 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-brand-600 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:file:bg-brand-600">
                                <p class="mt-1 truncate text-theme-xs text-gray-400 dark:text-gray-500">{{ $media->file_path }}</p>
                            </div>
                            <select name="media[{{ $loop->index }}][file_type]" class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                                <option value="image" {{ $media->file_type === 'image' ? 'selected' : '' }}>Image</option>
                                <option value="video" {{ $media->file_type === 'video' ? 'selected' : '' }}>Video</option>
                                <option value="document" {{ $media->file_type === 'document' ? 'selected' : '' }}>Document</option>
                            </select>
                            <input type="text" name="media[{{ $loop->index }}][title]" value="{{ $media->title }}" placeholder="Title" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            <div class="flex items-end">
                                <button type="button" class="remove-media px-2 text-sm text-error-500 hover:text-error-600" title="Remove">✕</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">
                    Update Project
                </button>
                <a href="{{ route('admin.projects.index') }}" class="text-theme-sm font-medium text-gray-700 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        const mediaContainer = document.getElementById('media-container');
        let mediaIndex = mediaContainer.children.length;

        function addMediaRow() {
            const row = document.createElement('div');
            row.className = 'media-row grid grid-cols-1 gap-3 rounded-lg bg-gray-50 p-3 dark:bg-white/[0.03] md:grid-cols-4';
            row.innerHTML = `
                <input type="file" name="media[${mediaIndex}][file]" class="w-full rounded-lg border border-gray-300 bg-transparent px-3 py-2.5 text-sm text-gray-800 shadow-theme-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-500 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-brand-600 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:file:bg-brand-600">
                <select name="media[${mediaIndex}][file_type]" class="h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                    <option value="image">Image</option>
                    <option value="video">Video</option>
                    <option value="document">Document</option>
                </select>
                <input type="text" name="media[${mediaIndex}][title]" value="" placeholder="Title" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                <div class="flex items-end">
                    <button type="button" class="remove-media px-2 text-sm text-error-500 hover:text-error-600" title="Remove">✕</button>
                </div>
            `;
            row.querySelector('.remove-media').addEventListener('click', () => row.remove());
            mediaContainer.appendChild(row);
            mediaIndex++;
        }

        document.getElementById('add-media').addEventListener('click', addMediaRow);

        document.querySelectorAll('.remove-media').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.media-row').remove();
            });
        });
    </script>
@endsection