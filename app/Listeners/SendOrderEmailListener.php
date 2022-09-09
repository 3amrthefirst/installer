<?php

namespace App\Listeners;

use App\Events\JobOrderEvent;
use App\Notifications\SendOrderEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderEmailListener
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
     * @param  JobOrderEvent  $event
     * @return void
     */
    public function handle(JobOrderEvent $event)
    {
        //
        $this->sendOrderEmail($event->user);
    }

    function sendOrderEmail($user){

        $user->notify(new SendOrderEmail());
    }
}
