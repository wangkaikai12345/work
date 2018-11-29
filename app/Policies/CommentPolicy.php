<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
//        if ( auth()->id() == 1 ) return true;

        if (in_array(\Request::getRequestUri(), config('work.hide'))) {
            return false;
        }

        if (auth()->user()->email === config('work.email_tips')) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can view the work.
     *
     * @param  \App\User  $user
     * @param  \App\Work  $work
     * @return mixed
     */
    public function view(User $user, Comment $comment)
    {
//        if (auth()->id() === 1) {
//            return true;
//        }
//
//        return $comment->user_id === auth()->id();
        return true;
    }

    /**
     * Determine whether the user can create works.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the work.
     *
     * @param  \App\User  $user
     * @param  \App\Work  $work
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        return $comment->user_id === auth()->id();
    }

    /**
     * Determine whether the user can delete the work.
     *
     * @param  \App\User  $user
     * @param  \App\Work  $work
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        //
        return false;
    }

    /**
     * Determine whether the user can restore the work.
     *
     * @param  \App\User  $user
     * @param  \App\Work  $work
     * @return mixed
     */
    public function restore(User $user, Comment $comment)
    {
        //
        return $comment->user_id === auth()->id();
    }

    /**
     * Determine whether the user can permanently delete the work.
     *
     * @param  \App\User  $user
     * @param  \App\Work  $work
     * @return mixed
     */
    public function forceDelete(User $user, Comment $comment)
    {
        //
        return false;
    }
}
