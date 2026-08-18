@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12 space-y-6">
            <!-- Metric Group -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 xl:grid-cols-4">
                <!-- Metric Item Start -->
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-50 dark:bg-brand-500/15">
                        <svg class="fill-brand-500 dark:fill-brand-400" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V9a2 2 0 00-2-2h-2a2 2 0 00-2 2" fill=""/>
                        </svg>
                    </div>
                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Projects</span>
                            <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">{{ $stats['projects'] }}</h4>
                        </div>
                    </div>
                </div>
                <!-- Metric Item End -->

                <!-- Metric Item Start -->
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-success-50 dark:bg-success-500/15">
                        <svg class="fill-success-500 dark:fill-success-400" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" fill=""/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" fill=""/>
                        </svg>
                    </div>
                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Technologies</span>
                            <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">{{ $stats['technologies'] }}</h4>
                        </div>
                    </div>
                </div>
                <!-- Metric Item End -->

                <!-- Metric Item Start -->
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 dark:bg-orange-500/15">
                        <svg class="fill-orange-500 dark:fill-orange-400" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" fill=""/>
                        </svg>
                    </div>
                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Inquiries</span>
                            <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">{{ $stats['inquiries'] }}</h4>
                        </div>
                    </div>
                </div>
                <!-- Metric Item End -->

                <!-- Metric Item Start -->
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-theme-purple-500/10 dark:bg-theme-purple-500/15">
                        <svg class="fill-theme-purple-500 dark:fill-theme-purple-500" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" fill=""/>
                        </svg>
                    </div>
                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Users</span>
                            <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">{{ $stats['users'] }}</h4>
                        </div>
                    </div>
                </div>
                <!-- Metric Item End -->
            </div>

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
                <!-- Recent Projects -->
                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="flex items-center justify-between px-5 py-4 sm:px-6 sm:py-5">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Recent Projects</h3>
                        <a href="{{ route('admin.projects.index') }}" class="text-theme-sm font-medium text-brand-500 hover:text-brand-600 dark:text-brand-400">View all</a>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-800">
                        <div class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse ($recentProjects as $project)
                                <div class="flex items-center justify-between gap-4 px-5 py-3.5 sm:px-6">
                                    <div class="flex min-w-0 items-center gap-3">
                                        @if ($project->featured_image)
                                            <img src="{{ $project->featured_image }}" alt="{{ $project->title }}" class="h-10 w-10 flex-shrink-0 rounded-lg object-cover">
                                        @else
                                            <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800">
                                                <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V9a2 2 0 00-2-2h-2a2 2 0 00-2 2" fill=""/>
                                                </svg>
                                            </span>
                                        @endif
                                        <div class="min-w-0">
                                            <p class="truncate text-theme-sm font-medium text-gray-800 dark:text-white/90">{{ $project->title }}</p>
                                            <p class="text-theme-xs mt-0.5 text-gray-500 dark:text-gray-400">{{ $project->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="px-5 py-4 text-theme-sm text-gray-500 dark:text-gray-400">No projects yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- New Inquiries -->
                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="flex items-center justify-between px-5 py-4 sm:px-6 sm:py-5">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">New Inquiries</h3>
                        <a href="{{ route('admin.inquiries.index') }}" class="text-theme-sm font-medium text-brand-500 hover:text-brand-600 dark:text-brand-400">View all</a>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-800">
                        <div class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse ($newInquiries as $inquiry)
                                <div class="px-5 py-3.5 sm:px-6">
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90">
                                            {{ $inquiry->name }}
                                            <span class="font-normal text-gray-400 dark:text-gray-500">({{ $inquiry->email }})</span>
                                        </p>
                                        <span class="flex-shrink-0 rounded-full bg-error-50 px-2.5 py-1 text-xs font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">New</span>
                                    </div>
                                    <p class="mt-1 line-clamp-2 text-theme-sm text-gray-600 dark:text-gray-400">{{ $inquiry->message }}</p>
                                    <p class="mt-1 text-theme-xs text-gray-400 dark:text-gray-500">{{ $inquiry->created_at->diffForHumans() }}</p>
                                </div>
                            @empty
                                <p class="px-5 py-4 text-theme-sm text-gray-500 dark:text-gray-400">No new inquiries.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection