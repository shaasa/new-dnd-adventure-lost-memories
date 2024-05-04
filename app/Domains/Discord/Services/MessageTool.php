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
        $embedBuilder = new EmbedBuilder();
        $embedBuilder->addAuthor('Me!');

        $componentBuilder = new ComponentBuilder();
        $componentBuilder->addActionButton('My Button', 'customId');

        return [
            'contentType' => 'rich',
            'channelId' => 'channel id',
            'embeds' => $embedBuilder->getEmbeds(),
            'components' => [
                $componentBuilder->getActionRow(),
            ],
        ];
    }
}
