<?php

namespace App\Livewire\Forms;

use App\Models\Player;
use App\Notifications\PrivateDiscordMessage;
use Livewire\Form;


class DiscordMessageForm extends Form
{

    public function __construct(public string $message)
    {

    }

    public function send(Player $player): void
    {
        ray($player);
        $player->notify(new PrivateDiscordMessage($this->message));

    }
}
