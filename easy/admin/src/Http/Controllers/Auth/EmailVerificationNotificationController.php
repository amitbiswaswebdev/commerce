<?php

namespace Easy\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Easy\Admin\AdminServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(AdminServiceProvider::ADMIN_HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
