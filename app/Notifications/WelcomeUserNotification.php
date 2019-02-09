<?php

namespace App\Notifications;

use App\Data\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WelcomeUserNotification extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;

    /**
     * WelcomeUserNotification constructor.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        #TODO implement send email
        return [];
    }
}