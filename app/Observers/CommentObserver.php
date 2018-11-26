<?php

namespace App\Observers;

use App\Comment;
use App\User;
use Illuminate\Support\Facades\Log;

class CommentObserver
{
    /**
     * 监听数据即将创建的事件。
     *
     * @param  User $user
     * @return void
     */
    public function creating(Comment $comment)
    {
        $comment->user_id = auth()->id();
    }

    /**
     * 监听数据创建后的事件。
     *
     * @param  User $user
     * @return void
     */
    public function created(Comment $comment)
    {
        if (auth()->id() === 1) {
            // 发送邮件
            dispatch(new \App\Jobs\CommentEmail($comment));

        } else {


            // 发送钉钉提醒
            $webhook = "https://oapi.dingtalk.com/robot/send?access_token=e0b2b28185c50a947c0f7af8b72117f5088dfd351737226862e879447dc3b20e";
            $message="我就是我, 是不一样的烟火";
            $data = array ('msgtype' => 'text','text' => array ('content' => $message));

            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', $webhook, [
                'json' => $data
            ]);

            Log::info('fasongchengg');
            Log::info(json_encode($res));
        }



    }

}
