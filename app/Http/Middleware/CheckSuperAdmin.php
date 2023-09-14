<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Notify;

class CheckSuperAdmin
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
        if (Auth::check()) {
            if (Auth::user()->isSuperAdmin()) {
                return $next($request);
            } else {
                Notify::error('You are not allowed to access this page.', 'Whoops!', $options = []);
                return redirect('/home');
            }
        } else {
            Notify::error('You need to login for this page access .', 'Whoops!', $options = []);
            return redirect('/');
        }
    }
}
