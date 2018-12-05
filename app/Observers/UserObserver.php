<?php

namespace App\Observers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * 监听数据更新后的事件。
     *
     * @param  User $user
     * @return void
     */
    public function updating(User $user)
    {
        if ($user->email) {
            $user->email_sub = $user->email;
        }
    }
}
