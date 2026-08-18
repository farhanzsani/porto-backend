@extends('admin.layouts.app')

@section('title', 'Inquiries')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Inquiries</h2>
                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Messages from your contact form</p>
            </div>
        </div>

        <form method="GET" class="flex items-center gap-2">
            <div class="relative">
                <select name="status" class="h-10 w-40 appearance-none rounded-lg border border-gray-300 bg-transparent py-2 pl-4 pr-8 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                    <option value="">All Statuses</option>
                    @foreach (['new', 'read', 'replied', 'archived', 'spam'] as $s)
                        <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-gray-900 px-4 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-gray-800 dark:bg-white/[0.03] dark:text-gray-400 dark:hover:bg-white/10">
                Filter
            </button>
        </form>

        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="w-full overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-y border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">From</p>
                            </th>
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Message</p>
                            </th>
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Status</p>
                            </th>
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Received</p>
                            </th>
                            <th class="px-5 py-3 text-right">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Actions</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($inquiries as $inquiry)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.03]">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-50 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
                                            {{ strtoupper(substr($inquiry->name, 0, 1)) }}
                                        </span>
                                        <div>
                                            <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90">{{ $inquiry->name }}</p>
                                            <p class="text-theme-xs mt-0.5 text-gray-500 dark:text-gray-400">{{ $inquiry->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="max-w-xs px-5 py-4 text-theme-sm text-gray-600 dark:text-gray-400">
                                    <p class="truncate">{{ $inquiry->message }}</p>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="rounded-full px-2.5 py-1 text-xs font-medium {{ $inquiry->status === 'new' ? 'bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500' : ($inquiry->status === 'replied' ? 'bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500' : ($inquiry->status === 'spam' ? 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400' : 'bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-400')) }}">
                                        {{ ucfirst($inquiry->status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-theme-sm text-gray-500 dark:text-gray-400">{{ $inquiry->created_at->diffForHumans() }}</td>
                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-brand-500 hover:bg-brand-50 hover:text-brand-600 dark:text-brand-400 dark:hover:bg-brand-500/10">View</a>
                                        <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-error-500 hover:bg-error-50 hover:text-error-600 dark:hover:bg-error-500/10">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-5 py-10 text-center text-theme-sm text-gray-500 dark:text-gray-400">No inquiries found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $inquiries->links() }}</div>
    </div>
@endsection