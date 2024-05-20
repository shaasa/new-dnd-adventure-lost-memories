<?php

namespace App\Livewire\Forms;

use App\Models\Player;
use App\Notifications\PrivateDiscordMessage;
use Livewire\Form;


class DiscordMessageForm extends Form
{

    public string $message;


    protected array $rules = [
        'message' => 'required|string|max:255',
    ];

    public function send(Player $player): void
    {
        ray($player);
        $player->notify(new PrivateDiscordMessage($this->message));

    }
}
