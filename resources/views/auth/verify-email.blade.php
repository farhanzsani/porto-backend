<x-guest-layout>
    <p class="mb-5 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 flex items-center gap-3 rounded-2xl border border-success-100 bg-success-50 px-4 py-3 text-sm font-medium text-success-700 dark:border-success-500/20 dark:bg-success-500/10 dark:text-success-500">
            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1.54199C5.32244 1.54199 1.54199 5.32244 1.54199 10C1.54199 14.6776 5.32244 18.458 10 18.458C14.6776 18.458 18.458 14.6776 18.458 10C18.458 5.32244 14.6776 1.54199 10 1.54199ZM13.4508 7.42482C13.7387 7.11835 13.7234 6.64366 13.4169 6.35579C13.1104 6.06792 12.6357 6.08321 12.3479 6.38969L8.64917 10.2947L7.54921 9.17168C7.26092 8.866 6.78618 8.85039 6.4805 9.13868C6.17482 9.42697 6.15921 9.90171 6.4475 10.2074L8.04879 11.8539C8.19769 12.0079 8.40706 12.0869 8.62124 12.0704C8.83542 12.0539 9.02913 11.9435 9.15022 11.7693L13.4508 7.42482Z" fill=""/>
            </svg>
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="flex items-center justify-between gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="flex items-center justify-center rounded-lg bg-brand-500 px-4 py-3 text-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>