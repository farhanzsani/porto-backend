<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            // Redirect berdasarkan role
            if (in_array($request->user()->role, ['admin', 'editor'])) {
                return redirect()->intended(route('admin.dashboard', absolute: false));
            }
            
            return redirect()->route('login')->with('error', 'You do not have permission to access the dashboard.');
        }
        
        return view('auth.verify-email');
    }
}
