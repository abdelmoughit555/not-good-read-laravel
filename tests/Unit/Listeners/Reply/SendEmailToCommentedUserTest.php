<?php

namespace Tests\Unit\Listeners\Reply;

use App\Events\Reply\ReplyCreated;
use App\Listeners\Reply\SendEmailToCommentedUser;
use Tests\TestCase;
use App\Models\Reply;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reply\ReplyToComment;

class SendEmailToCommentedUserTest extends TestCase
{
    public function test_it_send_an_email_when_firing_created_reply_event()
    {
        Mail::fake();

        $event = new ReplyCreated(
            $reply = factory(Reply::class)->create()
        );

        $listener = new SendEmailToCommentedUser();

        Mail::assertNothingSent();

        $listener->handle($event);

        Mail::assertQueued(function (ReplyToComment $mail) use ($reply) {
            return $mail->reply->id === $reply->id;
        });

        $user = $event->reply->comment->user;

        Mail::assertQueued(ReplyToComment::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
