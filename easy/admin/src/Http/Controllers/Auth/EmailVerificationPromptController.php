<?php

namespace Easy\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Easy\Admin\AdminServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(AdminServiceProvider::ADMIN_HOME)
                    : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
    }
}
