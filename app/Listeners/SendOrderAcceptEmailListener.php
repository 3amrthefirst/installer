<?php

namespace App\Listeners;

use App\Events\JobOrderAcceptedEvent;
use App\Notifications\SendAcceptedOrderEmail;
use App\Notifications\SendOrderEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderAcceptEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(JobOrderAcceptedEvent $event)
    {
        //
        $this->sendOrderEmail($event->user);
    }

    function sendOrderEmail($user){
        $user = auth()->user();
        $user->notify(new SendAcceptedOrderEmail());
    }
}
