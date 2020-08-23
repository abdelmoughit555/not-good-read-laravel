<?php

namespace App\Listeners\Reply;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Reply\ReplyCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reply\ReplyToComment;

class SendEmailToCommentedUser
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ReplyCreated $event)
    {
        return Mail::to($event->reply->comment->user)
            ->send(new ReplyToComment($event->reply));
    }
}
