<?php

namespace App\Events;

use App\Enums\TypeEnum;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ToggleCharacterSheet implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public User $player,
        public TypeEnum $sheetPart,
        public bool $show
    ) {

    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('App.Models.User.' . $this->player->id);
    }
}
