<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        if ($user->hasVerifiedEmail()) {
            // Redirect berdasarkan role
            if (in_array($user->role, ['admin', 'editor'])) {
                return redirect()->intended(route('admin.dashboard', absolute: false).'?verified=1');
            }
            
            return redirect()->route('login')->with('error', 'You do not have permission to access the dashboard.');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Redirect berdasarkan role
        if (in_array($user->role, ['admin', 'editor'])) {
            return redirect()->intended(route('admin.dashboard', absolute: false).'?verified=1');
        }
        
        return redirect()->route('login')->with('error', 'Email verified, but you need admin approval to access the dashboard.');
    }
}
