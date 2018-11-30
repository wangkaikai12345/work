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
        if ($comment->work->status === 'complete') {
            return;
        }

        if (auth()->id() === 1) {
            // 发送邮件
            dispatch(new \App\Jobs\CommentEmail($comment));

        } else {
            // 发送钉钉提醒
            dispatch(new \App\Jobs\UserComment($comment, 'comment'))->onQueue('comment');
        }

    }

}
