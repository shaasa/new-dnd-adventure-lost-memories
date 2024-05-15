<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class LoginLinkNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    public function via($notifiable): array
    {
        return [DiscordChannel::class];
    }

    public function toDiscord($notifiable): DiscordMessage
    {
        ray(DiscordChannel::class);

        $loginLink = $notifiable->generateLoginLink();
        ray($loginLink);
        $embed = [
            'title' =>'Login Link0',
            'description' => 'Click the link below to login:',
            'url' => $loginLink
            ];
            $discordMessage = new DiscordMessage();
            ray($discordMessage);
            $discordMessage->embed($embed);
            $discordMessage->body('Link per il login');
            ray($discordMessage);
        return $discordMessage;

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
