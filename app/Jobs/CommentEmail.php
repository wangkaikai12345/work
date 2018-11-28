<?php

namespace App\Jobs;

use App\Mail\WorkComment;
use App\User;
use App\Work;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;


class CommentEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $comment;

    /**
     * 定义任务超时时间
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addSeconds(5);
    }

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        //
        $this->comment = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $model = $this->comment;

        $work = Work::find($model->work_id);

        $url = config('app.url').'/admin/resources/comments/'.$model->id;

        //
        Mail::to($work->user)->send(new WorkComment($work->user, $work->title, $url));
    }
}
