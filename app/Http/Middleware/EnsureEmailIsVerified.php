<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureEmailIsVerified
{
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user() ||
            ($request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasVerifiedEmail()))
            {
              if (get_class($request->user()) === 'App\Models\Admin') {
                $path = 'admin.';
                } elseif (get_class($request->user()) === 'App\Models\ShopAdmin') {
                  $path = 'shopadmin.';
                } elseif (get_class($request->user()) === 'App\Models\User') {
                  $path = '';
              }
            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::guest(URL::route($redirectToRoute ?: $path . 'verification.notice'));
        }

        return $next($request);
    }
}