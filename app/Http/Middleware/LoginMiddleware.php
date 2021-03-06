<?php

namespace App\Http\Middleware;

use App\Comment;
use Closure;
use Illuminate\Support\Facades\Log;

class LoginMiddleware
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
        if (!auth()->user()) {

            return redirect(config('work.sso_server'));
        }

        if (! auth()->user()->email_sub) {

            auth()->user()->email_sub = config('work.email_tips');

            auth()->user()->save();

            return redirect('/admin/resources/users/'.auth()->id().'/edit');
        }

        return $next($request);
    }
}
