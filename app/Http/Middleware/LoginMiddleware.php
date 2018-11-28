<?php

namespace App\Http\Middleware;

use Closure;

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

        if (str_is('/admin/resources/comments/*', $request->getRequestUri())) {
            return $next($request);
        }

        if (!auth()->user()) {
            return redirect(config('work.sso_server'));
        }

        return $next($request);
    }
}
