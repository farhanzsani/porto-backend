@extends('admin.layouts.app')

@section('title', 'Certificates')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Certificates</h2>
                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Manage your professional certificates</p>
            </div>
            <a href="{{ route('admin.certificates.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">
                <svg class="fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 4.75C12.4142 4.75 12.75 5.08579 12.75 5.5V11.25H18.5C18.9142 11.25 19.25 11.5858 19.25 12C19.25 12.4142 18.9142 12.75 18.5 12.75H12.75V18.5C12.75 18.9142 12.4142 19.25 12 19.25C11.5858 19.25 11.25 18.9142 11.25 18.5V12.75H5.5C5.08579 12.75 4.75 12.4142 4.75 12C4.75 11.5858 5.08579 11.25 5.5 11.25H11.25V5.5C11.25 5.08579 11.5858 4.75 12 4.75Z" fill=""/>
                </svg>
                Add Certificate
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
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Issuing Organization</p>
                            </th>
                            <th class="px-5 py-3 text-left">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Issue Date</p>
                            </th>
                            <th class="px-5 py-3 text-left">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Expiry Date</p>
                            </th>
                            <th class="px-5 py-3 text-left">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Status</p>
                            </th>
                            <th class="px-5 py-3 text-left">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Actions</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($certificates as $certificate)
                            <tr>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($certificate->image_path)
                                            <img src="{{ $certificate->image_path }}" alt="{{ $certificate->title }}" class="h-9 w-9 rounded-lg object-cover shrink-0">
                                        @else
                                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800 shrink-0">
                                                <svg class="text-gray-400" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90">{{ $certificate->title }}</p>
                                            @if ($certificate->credential_id)
                                                <p class="text-theme-xs text-gray-400 dark:text-gray-500">ID: {{ $certificate->credential_id }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <p class="text-theme-sm text-gray-700 dark:text-gray-300">{{ $certificate->issuing_organization }}</p>
                                </td>
                                <td class="px-5 py-4">
                                    <p class="text-theme-sm text-gray-700 dark:text-gray-300">{{ $certificate->issue_date->format('M d, Y') }}</p>
                                </td>
                                <td class="px-5 py-4">
                                    @if ($certificate->expiry_date)
                                        <p class="text-theme-sm {{ $certificate->is_expired ? 'text-error-500' : 'text-gray-700 dark:text-gray-300' }}">
                                            {{ $certificate->expiry_date->format('M d, Y') }}
                                            @if ($certificate->is_expired)
                                                <span class="ml-1 text-theme-xs">(Expired)</span>
                                            @endif
                                        </p>
                                    @else
                                        <p class="text-theme-sm text-gray-400 dark:text-gray-500">No expiry</p>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    @if ($certificate->is_active)
                                        <span class="inline-flex items-center rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/10 dark:text-success-400">Active</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-0.5 text-theme-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-1">
                                        @if ($certificate->credential_url)
                                            <a href="{{ $certificate->credential_url }}" target="_blank" rel="noopener noreferrer" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-300">Verify</a>
                                        @endif
                                        <a href="{{ route('admin.certificates.edit', $certificate) }}" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:hover:bg-gray-800 dark:hover:text-gray-300">Edit</a>
                                        <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this certificate?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-error-500 hover:bg-error-50 hover:text-error-600 dark:hover:bg-error-500/10">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-10 text-center text-theme-sm text-gray-500 dark:text-gray-400">No certificates found. Add your first certificate.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $certificates->links() }}</div>
    </div>
@endsection

