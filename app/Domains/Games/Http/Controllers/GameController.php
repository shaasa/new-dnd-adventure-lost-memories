<?php

namespace App\Domains\Games\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a list of open games in welcome page.
     *
     * @return void
     */
    public function upsert(Request $request )
    {
        $data = $request->validate([]);
    }
}
