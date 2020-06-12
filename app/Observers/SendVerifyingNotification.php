<?php


namespace App\Observers;

use App\Events\PostVerified;
use App\Events\UserSubscribed;
use App\Services\Sms\SmsSender;

class SendVerifyingNotification
{
    /**
     * @var SmsSender
     */
    private $smsSender;

    /**
     * Create the event listener.
     *
     * @param SmsSender $smsSender
     */
    public function __construct(SmsSender $smsSender)
    {
        $this->smsSender = $smsSender;
    }

    /**
     * Handle the event.
     *
     * @param PostVerified $event
     * @return void
     */
    public function handle(PostVerified $event, UserSubscribed $sub)
    {
        $post = $event->getPost();
        $observer = $sub->getUser();
        $this->smsSender->send($observer->getPhone(), 'Post #' . $post->getId() . ' has been veryfied.');
    }
}
