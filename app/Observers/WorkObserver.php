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

    public function updating(Work $work)
    {
        if ($work->love_id && $work->status == 'unsolved') {
            $work->status = 'allot';
        }
    }

}
