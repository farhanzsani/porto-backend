@extends('admin.layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="space-y-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Profile</h2>
            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Manage your account information and password</p>
        </div>

        <div class="max-w-2xl space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-5 sm:p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-5 sm:p-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="rounded-2xl border border-error-200 bg-error-50/50 dark:border-error-500/20 dark:bg-error-500/5">
                <div class="p-5 sm:p-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection