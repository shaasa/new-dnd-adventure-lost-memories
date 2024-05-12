<?php

namespace App\Domains\Discord\Services;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Nwilging\LaravelDiscordBot\Contracts\Notifications\DiscordNotificationContract;
use Nwilging\LaravelDiscordBot\Support\Builder\ComponentBuilder;
use Nwilging\LaravelDiscordBot\Support\Builder\EmbedBuilder;

class MessageTool extends Notification implements DiscordNotificationContract
{
    use Queueable;

    public function via($notifiable): array
    {
        return ['discord'];
    }
    public function toDiscord($notifiable): array
    {
        return [
            'contentType' => 'plain',
            'channelId' => 'channel ID',
            'message' => 'message content',
        ];
    }
}
