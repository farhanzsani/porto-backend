@extends('admin.layouts.app')

@section('title', 'Technologies')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">All Technologies</h2>
                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Manage your skills and technologies</p>
            </div>
            <a href="{{ route('admin.technologies.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">
                <svg class="fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 4.75C12.4142 4.75 12.75 5.08579 12.75 5.5V11.25H18.5C18.9142 11.25 19.25 11.5858 19.25 12C19.25 12.4142 18.9142 12.75 18.5 12.75H12.75V18.5C12.75 18.9142 12.4142 19.25 12 19.25C11.5858 19.25 11.25 18.9142 11.25 18.5V12.75H5.5C5.08579 12.75 4.75 12.4142 4.75 12C4.75 11.5858 5.08579 11.25 5.5 11.25H11.25V5.5C11.25 5.08579 11.5858 4.75 12 4.75Z" fill=""/>
                </svg>
                New Technology
            </a>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="w-full overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-y border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Name</p>
                            </th>
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Proficiency</p>
                            </th>
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Experience</p>
                            </th>
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Featured</p>
                            </th>
                            <th class="px-5 py-3 text-right">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Actions</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($technologies as $technology)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.03]">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-lg text-sm font-bold" style="background-color: {{ $technology->color }}20; color: {{ $technology->color }}">
                                            {{ strtoupper(substr($technology->name, 0, 1)) }}
                                        </span>
                                        <div>
                                            <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90">{{ $technology->name }}</p>
                                            <p class="text-theme-xs mt-0.5 text-gray-500 dark:text-gray-400">{{ Str::limit($technology->description, 40) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="h-2 w-20 overflow-hidden rounded-full bg-gray-200 dark:bg-gray-800">
                                            <div class="h-full rounded-full bg-brand-500" style="width: {{ $technology->proficiency_level }}%"></div>
                                        </div>
                                        <span class="text-theme-xs text-gray-500 dark:text-gray-400">{{ $technology->proficiency_level }}%</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-theme-sm text-gray-500 dark:text-gray-400">{{ $technology->years_experience ? $technology->years_experience . ' yrs' : '—' }}</td>
                                <td class="px-5 py-4">
                                    @if ($technology->is_featured)
                                        <span class="rounded-full bg-brand-50 px-2.5 py-1 text-xs font-medium text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">Featured</span>
                                    @else
                                        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-500 dark:bg-gray-800 dark:text-gray-400">No</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.technologies.edit', $technology) }}" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-white/5">Edit</a>
                                        <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this technology?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-error-500 hover:bg-error-50 hover:text-error-600 dark:hover:bg-error-500/10">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-10 text-center text-theme-sm text-gray-500 dark:text-gray-400">No technologies found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $technologies->links() }}
        </div>
    </div>
@endsection