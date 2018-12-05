<?php

namespace App\Policies;

use App\User;
use App\System;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        if ( auth()->id() == 1 ) return true;
        if (
            in_array(\Request::getRequestUri(), config('work.hide'))
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
     * Determine whether the user can view the system.
     *
     * @param  \App\User  $user
     * @param  \App\System  $system
     * @return mixed
     */
    public function view(User $user, System $system)
    {
        //
        return $user->id === 1;
    }

    /**
     * Determine whether the user can create systems.
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
     * Determine whether the user can update the system.
     *
     * @param  \App\User  $user
     * @param  \App\System  $system
     * @return mixed
     */
    public function update(User $user, System $system)
    {
        //
        return $user->id === 1;
    }

    /**
     * Determine whether the user can delete the system.
     *
     * @param  \App\User  $user
     * @param  \App\System  $system
     * @return mixed
     */
    public function delete(User $user, System $system)
    {
        //
        return $user->id === 1;
    }

    /**
     * Determine whether the user can restore the system.
     *
     * @param  \App\User  $user
     * @param  \App\System  $system
     * @return mixed
     */
    public function restore(User $user, System $system)
    {
        //
        return $user->id === 1;
    }

    /**
     * Determine whether the user can permanently delete the system.
     *
     * @param  \App\User  $user
     * @param  \App\System  $system
     * @return mixed
     */
    public function forceDelete(User $user, System $system)
    {
        //
        return $user->id === 1;
    }
}
