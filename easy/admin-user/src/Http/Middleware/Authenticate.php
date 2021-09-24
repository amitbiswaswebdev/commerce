<?php

namespace Easy\AdminUser\Http\Middleware;

use App\Http\Middleware\Authenticate as AuthenticateMiddleware;
use Illuminate\Support\Arr;

class Authenticate extends AuthenticateMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (Arr::first($this->guards) === 'admin') {
                return route('admin.login');
            }
            return route('admin.login');
        }
    }
}
