@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Users</h2>
                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Manage admin panel users</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">
                <svg class="fill-current" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 4.75C12.4142 4.75 12.75 5.08579 12.75 5.5V11.25H18.5C18.9142 11.25 19.25 11.5858 19.25 12C19.25 12.4142 18.9142 12.75 18.5 12.75H12.75V18.5C12.75 18.9142 12.4142 19.25 12 19.25C11.5858 19.25 11.25 18.9142 11.25 18.5V12.75H5.5C5.08579 12.75 4.75 12.4142 4.75 12C4.75 11.5858 5.08579 11.25 5.5 11.25H11.25V5.5C11.25 5.08579 11.5858 4.75 12 4.75Z" fill=""/>
                </svg>
                New User
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
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Email</p>
                            </th>
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Role</p>
                            </th>
                            <th class="px-5 py-3">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Joined</p>
                            </th>
                            <th class="px-5 py-3 text-right">
                                <p class="font-medium text-theme-xs text-gray-500 uppercase dark:text-gray-400">Actions</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.03]">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-brand-50 text-sm font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </span>
                                        <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90">
                                            {{ $user->name }}
                                            @if ($user->id === auth()->id())
                                                <span class="text-theme-xs text-gray-400">(you)</span>
                                            @endif
                                        </p>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-theme-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</td>
                                <td class="px-5 py-4">
                                    <span class="rounded-full px-2.5 py-1 text-xs font-medium {{ $user->role === 'admin' ? 'bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-400' : ($user->role === 'editor' ? 'bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-warning-500' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-theme-sm text-gray-500 dark:text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-400 dark:hover:bg-white/5">Edit</a>
                                        @if ($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="rounded-lg px-2.5 py-1.5 text-theme-sm font-medium text-error-500 hover:bg-error-50 hover:text-error-600 dark:hover:bg-error-500/10">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-5 py-10 text-center text-theme-sm text-gray-500 dark:text-gray-400">No users found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $users->links() }}</div>
    </div>
@endsection