<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class SubscriptionExpiryNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */


    public function toDatabase(object $notifiable)
    {
        $days = now()->diffInDays($notifiable->subscription_end_data);;

        return [
            'body' => "يرجى تجديد الاشتراك .اشتراكك في الموقع سينتهي قريبًا يتبقى لاشتراكك {$days} أيام",
            'icon' => "fas fa-bell",
            'url'  => route('payment'),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
