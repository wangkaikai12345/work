<?php

namespace App\Http\Middleware;

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

        if (! auth()->user()->email) {

            auth()->user()->email = config('work.email_tips');

            auth()->user()->save();

            return redirect('/admin/resources/users/'.auth()->id().'/edit');
        }

        $id = auth()->user()->create_work;
        $comment_id = auth()->user()->create_comment;


        if ( $id && str_is('/nova-api/comments/*', $request->getRequestUri())) {
            auth()->user()->create_work = 0;
            auth()->user()->save();

            return redirect('/nova-api/works/'.$id);
        }
//
        if ($comment_id &&
            str_is('/nova-api/comments?search=&filters=&orderBy=&orderByDirection=desc&perPage=25&trashed=&page=1&viaResource=comments&viaResourceId=*', $request->getRequestUri())
        ) {
            auth()->user()->create_comment = 0;
            auth()->user()->save();

            return redirect('/nova-api/comments?search=&filters=&orderBy=&orderByDirection=desc&perPage=25&trashed=&page=1&viaResource=comments&viaResourceId='.$id.'&viaRelationship=comments&relationshipType=hasMany');
        }

        return $next($request);
    }
}
