<?php

namespace App\Policies;

use App\User;
use App\Type;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypePolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        if ( auth()->id() == 1 ) return true;
        if (in_array(\Request::getRequestUri(), config('work.hide'))
            || str_is('/admin/resources/works/*', \Request::getRequestUri())
            || str_is('/admin/resources/comments/*', \Request::getRequestUri())
        ) {
            return false;
        }
        if (auth()->user()->email_sub === config('work.email_tips')) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can view the type.
     *
     * @param  \App\User  $user
     * @param  \App\Type  $type
     * @return mixed
     */
    public function view(User $user, Type $type)
    {
        //
        return $user->id === 1;
    }

    /**
     * Determine whether the user can create types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->id === 1;
    }

    /**
     * Determine whether the user can update the type.
     *
     * @param  \App\User  $user
     * @param  \App\Type  $type
     * @return mixed
     */
    public function update(User $user, Type $type)
    {
        //
        return $user->id === 1;
    }

    /**
     * Determine whether the user can delete the type.
     *
     * @param  \App\User  $user
     * @param  \App\Type  $type
     * @return mixed
     */
    public function delete(User $user, Type $type)
    {
        //
        return $user->id === 1;
    }

    /**
     * Determine whether the user can restore the type.
     *
     * @param  \App\User  $user
     * @param  \App\Type  $type
     * @return mixed
     */
    public function restore(User $user, Type $type)
    {
        //
        return $user->id === 1;
    }

    /**
     * Determine whether the user can permanently delete the type.
     *
     * @param  \App\User  $user
     * @param  \App\Type  $type
     * @return mixed
     */
    public function forceDelete(User $user, Type $type)
    {
        //
        return $user->id === 1;
    }
}
