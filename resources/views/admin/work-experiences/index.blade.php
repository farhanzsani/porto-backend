@extends('admin.layouts.app')

@section('title', 'Work Experiences')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Work Experiences</h2>
                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Manage your work history</p>
            </div>
            <a href="{{ route('admin.work-experiences.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">
                <svg class="fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 4.75C12.4142 4.75 12.75 5.08579 12.75 5.5V11.25H18.5C18.9142 11.25 19.25 11.5858 19.25 12C19.25 12.4142 18.9142 12.75 18.5 12.75H12.75V18.5C12.75 18.9142 12.4142 19.25 12 19.25C11.5858 19.25 11.25 18.9142 11.25 18.5V12.75H5.5C5.08579 12.75 4.75 12.4142 4.75 12C4.75 11.5858 5.08579 11.25 5.5 11.25H11.25V5.5C11.25 5.08579 11.5858 4.75 12 4.75Z" fill=""/>
                </svg>
                New Experience
            </a>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="w-full overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-y border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Position</p>
                            </th>
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Company</p>
                            </th>
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Type</p>
                            </th>
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Period</p>
                            </th>
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Current</p>
                            </th>
                            <th class="px-5 py-3 text-right">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Actions</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($experiences as $experience)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.03]">
                                <td class="px-5 py-4 text-theme-sm font-medium text-gray-800 dark:text-white/90">{{ $experience->position }}</td>
                                <td class="px-5 py-4 text-theme-sm text-gray-600 dark:text-gray-400">{{ $experience->company_name }}</td>
                                <td class="px-5 py-4">
                                    <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">{{ ucwords(str_replace('_', ' ', $experience->employment_type)) }}</span>
                                </td>
                                <td class="px-5 py-4 text-theme-sm text-gray-600 dark:text-gray-400">
                                    {{ $experience->start_date->format('M Y') }} - {{ $experience->is_current ? 'Present' : ($experience->end_date?->format('M Y') ?? '—') }}
                                </td>
                                <td class="px-5 py-4">
                                    @if ($experience->is_current)
                                        <span class="rounded-full bg-success-50 px-2.5 py-1 text-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">Current</span>
                                    @else
                                        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-500 dark:bg-gray-800 dark:text-gray-400">No</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.work-experiences.edit', $experience) }}" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-white/5">Edit</a>
                                        <form action="{{ route('admin.work-experiences.destroy', $experience) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-error-500 hover:bg-error-50 hover:text-error-600 dark:hover:bg-error-500/10">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-5 py-10 text-center text-theme-sm text-gray-500 dark:text-gray-400">No work experiences found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $experiences->links() }}</div>
    </div>
@endsection