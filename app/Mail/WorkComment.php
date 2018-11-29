<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WorkComment extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $user;
    public $url;

    public $subject = '【工单对话】';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $title, $url)
    {
        //
        $this->title = $title;
        $this->user = $user;
        $this->url = $url;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.comment');
    }
}
