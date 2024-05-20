<?php

namespace App\Domains\Players\Http\Controllers;


use App\Enums\TypeEnum;
use App\Events\ToggleCharacterSheet;
use App\Http\Controllers\Controller;
use App\Models\Player;


class PlayerGameController extends Controller
{
    public function toggle(Player $player, TypeEnum $fase)
    {
        ToggleCharacterSheet::dispatch($player,$fase,1);
    }


}
