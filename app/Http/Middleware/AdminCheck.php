<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Redirect;

class AdminCheck
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
        if (!Auth::check()) {
            return Redirect::to('users/signin')
                ->with('flash_message', 'Please login');
        }
        elseif (!Auth::user()->admin) {
            return Redirect::to('/')
                ->with('flash_message', 'You are not authorise');
        }

        return $next($request);
    }
}
