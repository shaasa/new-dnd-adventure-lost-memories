<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{


    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
        User::where('token', '=', $data['token'])->first()->sendLoginLink();
        session()->flash('success', true);
        return redirect()->back();
    }

    public function verifyLogin(Request $request, string $token, Game $game): Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
    {
        $player = User::where('token', $token)->firstOrFail();
        abort_unless($request->hasValidSignature() && $token, 401);

        Auth::login($player);
        $authToken = $player->createToken('authToken')->plainTextToken;
        if ($player->getRedirectRoute() === 'admin') {

            return view('dashboard', compact('authToken'));
        }

        return view('dashboard-player', ['game' => $game], compact('authToken'));
    }
}
