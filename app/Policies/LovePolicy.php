<?php

namespace App\Policies;

use App\User;
use App\Love;
use Illuminate\Auth\Access\HandlesAuthorization;

class LovePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the love.
     *
     * @param  \App\User  $user
     * @param  \App\Love  $love
     * @return mixed
     */
    public function view(User $user, Love $love)
    {
        return $user->id === 1;
    }

    /**
     * Determine whether the user can create love.
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
     * Determine whether the user can update the love.
     *
     * @param  \App\User  $user
     * @param  \App\Love  $love
     * @return mixed
     */
    public function update(User $user, Love $love)
    {
        //
        return $user->id === 1;
    }

    /**
     * Determine whether the user can delete the love.
     *
     * @param  \App\User  $user
     * @param  \App\Love  $love
     * @return mixed
     */
    public function delete(User $user, Love $love)
    {
        //
        return $user->id === 1;
    }

    /**
     * Determine whether the user can restore the love.
     *
     * @param  \App\User  $user
     * @param  \App\Love  $love
     * @return mixed
     */
    public function restore(User $user, Love $love)
    {
        //
        return $user->id === 1;
    }

    /**
     * Determine whether the user can permanently delete the love.
     *
     * @param  \App\User  $user
     * @param  \App\Love  $love
     * @return mixed
     */
    public function forceDelete(User $user, Love $love)
    {
        //
        return $user->id === 1;
    }
}
