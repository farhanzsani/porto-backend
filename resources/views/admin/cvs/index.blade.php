@extends('admin.layouts.app')

@section('title', 'CV Files')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">CV Files</h2>
                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Manage your CV files for download</p>
            </div>
            <a href="{{ route('admin.cvs.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">
                <svg class="fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 4.75C12.4142 4.75 12.75 5.08579 12.75 5.5V11.25H18.5C18.9142 11.25 19.25 11.5858 19.25 12C19.25 12.4142 18.9142 12.75 18.5 12.75H12.75V18.5C12.75 18.9142 12.4142 19.25 12 19.25C11.5858 19.25 11.25 18.9142 11.25 18.5V12.75H5.5C5.08579 12.75 4.75 12.4142 4.75 12C4.75 11.5858 5.08579 11.25 5.5 11.25H11.25V5.5C11.25 5.08579 11.5858 4.75 12 4.75Z" fill=""/>
                </svg>
                Upload CV
            </a>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="w-full overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-y border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3 text-left">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Title</p>
                            </th>
                            <th class="px-5 py-3 text-left">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">File</p>
                            </th>
                            <th class="px-5 py-3 text-left">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Size</p>
                            </th>
                            <th class="px-5 py-3 text-left">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Status</p>
                            </th>
                            <th class="px-5 py-3 text-left">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Uploaded</p>
                            </th>
                            <th class="px-5 py-3 text-left">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Actions</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($cvs as $cv)
                            <tr>
                                <td class="px-5 py-4">
                                    <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90">{{ $cv->title }}</p>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <svg class="text-gray-400 dark:text-gray-500 shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                                        </svg>
                                        <span class="text-theme-sm text-gray-600 dark:text-gray-400">{{ $cv->original_filename }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="text-theme-sm text-gray-600 dark:text-gray-400">{{ $cv->file_size_formatted }}</span>
                                </td>
                                <td class="px-5 py-4">
                                    @if ($cv->is_active)
                                        <span class="inline-flex items-center rounded-full bg-success-50 px-2.5 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/10 dark:text-success-400">Active</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-theme-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <span class="text-theme-sm text-gray-500 dark:text-gray-400">{{ $cv->created_at->format('d M Y') }}</span>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('admin.cvs.edit', $cv) }}" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white/90">Edit</a>
                                        <a href="{{ Storage::url($cv->file_path) }}" target="_blank" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-brand-600 hover:bg-brand-50 dark:text-brand-400 dark:hover:bg-brand-500/10">Preview</a>
                                        <form action="{{ route('admin.cvs.destroy', $cv) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this CV?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-error-500 hover:bg-error-50 hover:text-error-600 dark:hover:bg-error-500/10">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-10 text-center text-theme-sm text-gray-500 dark:text-gray-400">No CV files found. Upload your first CV.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $cvs->links() }}</div>
    </div>
@endsection
