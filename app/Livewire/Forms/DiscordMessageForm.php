<?php

namespace App\Livewire\Forms;

use App\Models\User;
use App\Notifications\PrivateDiscordMessage;
use Livewire\Form;


class DiscordMessageForm extends Form
{

    public string $message;


    protected array $rules = [
        'message' => 'required|string|max:255',
    ];

    public function send(User $player): void
    {
       $player->notify(new PrivateDiscordMessage($this->message));

    }
}
