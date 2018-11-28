<?php

namespace App\Jobs;

use App\Mail\Success;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SuccessEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $work;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        //
        $this->work = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $model = $this->work;

        $url = config('app.url').'/admin/resources/works/'.$model->id;

        if ($model->status == 'allot') {
            Mail::to($model->user)->send(new Success($model->user, $model->title, $url));
            $model->status = 'confirm';
            $model->save();
        }
    }
}
