<?php

namespace App\Jobs;

use App\Work;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UserComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $comment;

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

        $work = Work::find($this->comment->work_id);

        if (!$work || empty($work->love->phone)) return;

        // 发送钉钉提醒
        $webhook = config('work.hook');

        $message= '您的客户【'.$work->user->name.'】对工单【'.$work->title.'】做了最新评论，请注意查看';

        $data = array (
            'msgtype' => 'text',
            'text' => array ('content' => $message),
            'at' => [
                'atMobiles' => [
                    $work->love->phone
                ],
                'isAtAll' => false
            ]
        );

        $client = new \GuzzleHttp\Client();

        $client->request('POST', $webhook, [
            'json' => $data
        ]);
    }
}
