<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;
use App\Events\ExampleEvent;
use App\Notifications\WelcomeUserNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateUserListener
{
    use InteractsWithQueue;

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
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(CreateUserEvent $event)
    {
        # send user info
        app(\Illuminate\Notifications\ChannelManager::class)->send( $event->user, new WelcomeUserNotification($event->user));
    }
}
