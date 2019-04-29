<?php
use NotificationChannels\ExpoPushNotifications\ExpoChannel;
use NotificationChannels\ExpoPushNotifications\ExpoMessage;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [ExpoChannel::class];
    }

    public function toExpoPush($notifiable)
    {
        return ExpoMessage::create()
            ->badge(1)
            ->enableSound()
            ->body("Your {$notifiable->service} account was approved!");
    }
}