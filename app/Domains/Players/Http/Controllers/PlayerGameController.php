<?php

namespace App\Domains\Players\Http\Controllers;


use App\Http\Controllers\Controller;


class PlayerGameController extends Controller
{
    public function show(int $playerId, int $faseNum)
    {
        //TODO: Usare reverb per far apparire i vari pezzi della scheda
    }

    public function hide(int $playerId, int $faseNum)
    {
        //TODO: Usare reverb per nascondere i vari pezzi della scheda
    }
}
