<?php

namespace App\Observers;

use App\Work;

class WorkObserver
{

    public function creating(Work $work)
    {
        $work->user_id = auth()->id();

        $work->status = 'unsolved';
    }

    public function created(Work $work)
    {
        // 发送钉钉提醒
        dispatch(new \App\Jobs\UserComment($work, 'create'))->onQueue('comment');
    }

    public function updating(Work $work)
    {
        if ($work->love_id && $work->status == 'unsolved') {
            $work->status = 'allot';
        }
    }

    public function updated(Work $work)
    {
        if (!$work->is_send && $work->love_id) {
            // 发送钉钉提醒
            dispatch(new \App\Jobs\UserComment($work, 'update'))->onQueue('comment');
        }
    }

}
