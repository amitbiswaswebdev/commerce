<?php

namespace Easy\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Easy\Admin\AdminServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @return Response
     */
    public function show(): Response
    {
        return Inertia::render('Auth/ConfirmPassword');
    }

    /**
     * Confirm the user's password.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('admin')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(AdminServiceProvider::ADMIN_HOME);
    }
}
