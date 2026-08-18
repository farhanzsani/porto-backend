@extends('admin.layouts.app')

@section('title', $project->title)

@section('content')
    <div class="max-w-4xl space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.projects.index') }}" class="text-theme-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">← Back to Projects</a>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.projects.edit', $project) }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">
                    Edit Project
                </a>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            @if ($project->featured_image)
                <img src="{{ $project->featured_image }}" alt="{{ $project->title }}" class="h-64 w-full object-cover">
            @endif
            <div class="space-y-6 p-5 sm:p-6">
                <div>
                    <div class="mb-2 flex flex-wrap items-center gap-3">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $project->title }}</h1>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400">{{ $project->description }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 border-t border-gray-100 pt-4 dark:border-gray-800 md:grid-cols-4">
                    @if ($project->client)
                        <div>
                            <p class="text-theme-xs font-medium uppercase text-gray-500 dark:text-gray-400">Client</p>
                            <p class="text-theme-sm text-gray-800 dark:text-white/90">{{ $project->client }}</p>
                        </div>
                    @endif
                    <div>
                        <p class="text-theme-xs font-medium uppercase text-gray-500 dark:text-gray-400">Views</p>
                        <p class="text-theme-sm text-gray-800 dark:text-white/90">{{ $project->view_count }}</p>
                    </div>
                </div>

                @if ($project->project_url || $project->github_url)
                    <div class="flex flex-wrap gap-3">
                        @if ($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-lg bg-gray-900 px-4 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-gray-800 dark:bg-white/10 dark:hover:bg-white/15">
                                Live Demo
                            </a>
                        @endif
                        @if ($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                GitHub
                            </a>
                        @endif
                    </div>
                @endif

                <div class="max-w-none space-y-3 text-theme-sm leading-7 text-gray-700 dark:text-gray-400 [&_a]:text-brand-500 [&_a:hover]:text-brand-600 [&_h1]:text-2xl [&_h2]:text-xl [&_h3]:text-lg [&_ul]:list-disc [&_ul]:pl-5 [&_ol]:list-decimal [&_ol]:pl-5 [&_img]:rounded-xl [&_blockquote]:border-l-4 [&_blockquote]:border-gray-200 [&_blockquote]:pl-4 dark:[&_blockquote]:border-gray-700">
                    {!! $project->content !!}
                </div>

                @if ($project->media->isNotEmpty())
                    <div class="border-t border-gray-100 pt-4 dark:border-gray-800">
                        <p class="text-theme-xs font-medium uppercase text-gray-500 dark:text-gray-400">Media Gallery</p>
                        <div class="mt-3 grid grid-cols-2 gap-3 md:grid-cols-4">
                            @foreach ($project->media as $media)
                                <div class="rounded-lg bg-gray-50 p-3 dark:bg-white/[0.03]">
                                    <p class="text-xs font-medium text-gray-700 truncate dark:text-white/90">{{ $media->title ?? basename($media->file_path) }}</p>
                                    <p class="text-theme-xs text-gray-400 truncate dark:text-gray-500">{{ $media->file_path }}</p>
                                    <p class="text-theme-xs mt-1 text-gray-400 dark:text-gray-500">{{ ucfirst($media->file_type) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="border-t border-gray-100 pt-4 dark:border-gray-800">
                    <p class="text-theme-xs font-medium uppercase text-gray-500 dark:text-gray-400">Technologies Used</p>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach ($project->technologies as $technology)
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs text-gray-700 dark:bg-gray-800 dark:text-gray-400">{{ $technology->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection