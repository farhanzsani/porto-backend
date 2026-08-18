<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            // Redirect berdasarkan role
            if (in_array($request->user()->role, ['admin', 'editor'])) {
                return redirect()->intended(route('admin.dashboard', absolute: false));
            }
            
            return redirect()->route('login')->with('error', 'You do not have permission to access the dashboard.');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
