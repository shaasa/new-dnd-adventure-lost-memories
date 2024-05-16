<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class SendDiscordMessage extends Component
{
    public string $message = '';
    public int $player_private_channel_id = 0;

    public function send()
    {


        session()->flash('status', 'Post successfully updated.');

        return $this->redirect('/posts');
    }

    public function render()
    {
        return view('livewire.send-discord-mesage');
    }
}
