<?php

namespace App\Livewire;

use App\Livewire\Forms\DiscordMessageForm;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class SendDiscordMessage extends ModalComponent
{
    public User $player;
    public DiscordMessageForm $form;

    public function send(): void
    {
        $this->form->send($this->player);
    }

    public function render(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.send-discord-message');
    }
}
