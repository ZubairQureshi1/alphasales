<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session as SystemSession;
use Notify;

class CheckForGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public $empty_session_title = 'Whoops!';
    public $empty_session_message = 'Please select session first to proceed.';
    public $empty_campus_message = 'Please select campus first to proceed.';

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->IsGuest()) {
                return new RedirectResponse(url('/'));
            }
            if (!Auth::user()->isSuperAdmin()) {
                return $next($request);
                if (!empty(SystemSession::get('organization_campus_id'))) {
                    if (!empty(SystemSession::get('selected_session_id'))) {
                        return $next($request);
                    } else {
                        Notify::error($this->empty_session_message, $this->empty_session_title = null, $options = []);
                        return redirect('/home');
                    }
                } else {
                    Notify::error($this->empty_campus_message, $this->empty_session_title = null, $options = []);
                    return redirect('/home');
                }
            } else {
                return $next($request);
            }
        }
    }
}
