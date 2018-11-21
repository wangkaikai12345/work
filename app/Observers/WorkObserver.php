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


}
