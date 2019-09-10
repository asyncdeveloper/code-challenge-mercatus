<?php

namespace App\Mail;

use App\Models\Subscriber;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriberJoined extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function build()
    {
        return $this->markdown('emails.subscribers.joined-waitlist')
            ->subject('Someone joined the waitlist')
            ->replyTo($this->subscriber->email);
    }
}
