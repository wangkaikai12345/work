<?php

namespace Wangkai\SomeTips\Http\Middleware;

use Wangkai\SomeTips\SomeTips;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(SomeTips::class)->authorize($request) ? $next($request) : abort(403);
    }
}
