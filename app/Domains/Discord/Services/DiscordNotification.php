<?php

namespace App\Domains\Discord\Services;

use App\Models\Player;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class DiscordNotification extends Notification
{


    public function __construct(public Player $player)
    {
    }

    public function via($notifiable): array
    {
        return [DiscordChannel::class];
    }

    public function toDiscord($notifiable): DiscordMessage
    {
        return DiscordMessage::create("Test");
    }
}