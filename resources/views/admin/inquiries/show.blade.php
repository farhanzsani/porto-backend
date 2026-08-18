@extends('admin.layouts.app')

@section('title', 'Inquiry from ' . $inquiry->name)

@section('content')
    <div class="max-w-4xl space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.inquiries.index') }}" class="text-theme-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Back to Inquiries</a>
            <div class="flex items-center gap-3">
                <form action="{{ route('admin.inquiries.update-status', $inquiry) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" onchange="this.form.submit()" class="h-10 w-40 appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:focus:border-brand-800">
                        @foreach (['new', 'read', 'replied', 'archived', 'spam'] as $s)
                            <option value="{{ $s }}" {{ $inquiry->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </form>
                <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="rounded-lg px-3 py-2 text-theme-sm font-medium text-error-500 hover:bg-error-50 hover:text-error-600 dark:hover:bg-error-500/10">Delete</button>
                </form>
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-3">
                    <span class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-brand-50 text-base font-bold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
                        {{ strtoupper(substr($inquiry->name, 0, 1)) }}
                    </span>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ $inquiry->name }}</h1>
                        <p class="text-theme-sm text-gray-500 dark:text-gray-400">{{ $inquiry->email }}</p>
                        @if ($inquiry->phone)
                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">{{ $inquiry->phone }}</p>
                        @endif
                    </div>
                </div>
                <span class="rounded-full px-2.5 py-1 text-xs font-medium {{ $inquiry->status === 'new' ? 'bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500' : ($inquiry->status === 'replied' ? 'bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500' : ($inquiry->status === 'spam' ? 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400' : 'bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-400')) }}">
                    {{ ucfirst($inquiry->status) }}
                </span>
            </div>

            <div class="mt-5 grid grid-cols-2 gap-4 border-t border-gray-100 pt-4 dark:border-gray-800 md:grid-cols-4">
                <div>
                    <p class="text-theme-xs font-medium uppercase text-gray-500 dark:text-gray-400">Received</p>
                    <p class="text-theme-sm text-gray-800 dark:text-white/90">{{ $inquiry->created_at->format('M d, Y H:i') }}</p>
                </div>
                @if ($inquiry->company)
                    <div>
                        <p class="text-theme-xs font-medium uppercase text-gray-500 dark:text-gray-400">Company</p>
                        <p class="text-theme-sm text-gray-800 dark:text-white/90">{{ $inquiry->company }}</p>
                    </div>
                @endif
                @if ($inquiry->budget_range)
                    <div>
                        <p class="text-theme-xs font-medium uppercase text-gray-500 dark:text-gray-400">Budget</p>
                        <p class="text-theme-sm text-gray-800 dark:text-white/90">{{ $inquiry->budget_range }}</p>
                    </div>
                @endif
            </div>

            <div class="mt-5 border-t border-gray-100 pt-4 dark:border-gray-800">
                <p class="text-theme-xs font-medium uppercase text-gray-500 dark:text-gray-400">Message</p>
                <p class="mt-2 whitespace-pre-wrap text-theme-sm text-gray-800 dark:text-white/90">{{ $inquiry->message }}</p>
            </div>

            @if ($inquiry->ip_address)
                <div class="mt-5 border-t border-gray-100 pt-4 text-theme-xs text-gray-400 dark:border-gray-800 dark:text-gray-500">
                    IP: {{ $inquiry->ip_address }} {{ Str::limit($inquiry->user_agent ?? '', 100) }}
                </div>
            @endif
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Replies</h3>
            </div>
            <div class="space-y-3 p-5 sm:p-6">
                @forelse ($inquiry->replies as $reply)
                    <div class="rounded-lg bg-gray-50 p-4 dark:bg-white/[0.03]">
                        <div class="mb-1 flex items-center justify-between">
                            <p class="text-theme-sm font-medium text-gray-900 dark:text-white/90">{{ $reply->user?->name ?? 'Unknown' }}</p>
                            <p class="text-theme-xs text-gray-400 dark:text-gray-500">{{ $reply->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <p class="whitespace-pre-wrap text-theme-sm text-gray-700 dark:text-gray-400">{{ $reply->message }}</p>
                    </div>
                @empty
                    <p class="text-theme-sm text-gray-500 dark:text-gray-400">No replies yet.</p>
                @endforelse
            </div>

            <form action="{{ route('admin.inquiries.reply', $inquiry) }}" method="POST" class="space-y-3 border-t border-gray-100 p-5 dark:border-gray-800 sm:p-6">
                @csrf
                <div>
                    <label for="message" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">Send Reply</label>
                    <textarea name="message" id="message" rows="4" required class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">{{ old('message') }}</textarea>
                    @error('message')<p class="text-error-600 mt-1 text-xs dark:text-error-400">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">
                    Send Reply
                </button>
            </form>
        </div>
    </div>
@endsection