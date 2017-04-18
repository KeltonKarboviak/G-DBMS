<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckFirstTimeLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->password_updated_at === null)
            return redirect()->route('user.update', Auth::user())
                ->with('alert-warning', 'You must change your password after the first login.');

        return $next($request);
    }
}
