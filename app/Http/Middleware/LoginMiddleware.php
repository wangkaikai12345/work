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

        if (! auth()->user()->email) {

            auth()->user()->email = config('work.email_tips');

            auth()->user()->save();

            return redirect('/admin/resources/users/'.auth()->id().'/edit');
        }

//        $id = auth()->user()->create_work;
//
//        if ( $id && str_is('/nova-api/comments/*', $request->getRequestUri())) {
//
//            return redirect('/nova-api/works/'.$id);
//        }
////
//        if ($id &&
//            str_is('/nova-api/comments?search=&filters=&orderBy=&orderByDirection=desc&perPage=25&trashed=&page=1&viaResource=comments&viaResourceId=*', $request->getRequestUri())
//        ) {
//            auth()->user()->create_work = 0;
//            auth()->user()->save();
//
//            return redirect('/nova-api/comments?search=&filters=&orderBy=&orderByDirection=desc&perPage=25&trashed=&page=1&viaResource=works&viaResourceId='.$id.'&viaRelationship=comments&relationshipType=hasMany');
//        }

        return $next($request);
    }
}
