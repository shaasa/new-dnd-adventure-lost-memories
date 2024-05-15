<?php

namespace App\Domains\Players\Actions;

use App\Models\Game;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;


class GenerateToken
{
    public function execute(): string
    {
        return hash('sha256', Str::random(32));
    }

}
