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
    private $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($model, $type)
    {
        //
        $this->comment = $model;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 发送钉钉提醒
        $webhook = config('work.hook');

        $data = [];

        if ($this->type == 'comment') {
            $work = Work::find($this->comment->work_id);

            if (!$work || empty($work->love->phone)) return;



            $message= '您的客户【'.$work->user->name.'】对工单【'.$work->title.'】做了最新评论，请注意查看';

            $url = config('app.url').'/admin/resources/comments/'.$this->comment->id;

            $data = array (
                'msgtype' => 'markdown',
                'markdown' => [
                    'title'=> '@'.$work->love->phone,
                    'text' => "#### @".$work->love->phone."  \n > ".$message."\n\n >  #### [点击查看](".$url.") "
                ],
                'at' => [
                    'atMobiles' => [
                        $work->love->phone
                    ],
                    'isAtAll' => false
                ]
            );
        }

        if ($this->type == 'create') {

            $work = $this->comment;

            $message= '客户【'.$work->user->name.'】提交了工单【'.$work->title.'】，请分配处理...';

            $data = array (
                'msgtype' => 'markdown',
                'markdown' => [
                    'title'=> '@'.config('work.admin_phone'),
                    'text' => "#### @".config('work.admin_phone')."  \n > ".$message."\n\n > "
                ],
                'at' => [
                    'atMobiles' => [
                        config('work.admin_phone')
                    ],
                    'isAtAll' => false
                ]
            );
        }

        if ($this->type == 'update') {

            $work = $this->comment;

            if (!$work || empty($work->love->phone)) return;

            $message= '客户【'.$work->user->name.'】的工单【'.$work->title.'】已分配给你，请抓紧时间处理';

            $data = array (
                'msgtype' => 'markdown',
                'markdown' => [
                    'title'=> '@'.$work->love->phone,
                    'text' => "#### @".$work->love->phone."  \n > ".$message."\n\n > "
                ],
                'at' => [
                    'atMobiles' => [
                        $work->love->phone
                    ],
                    'isAtAll' => false
                ]
            );

            $work->is_send = 1;
            $work->save();
        }

        $client = new \GuzzleHttp\Client();

        $client->request('POST', $webhook, [
            'json' => $data
        ]);
    }
}
