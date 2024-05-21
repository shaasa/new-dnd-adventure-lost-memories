<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\User;

use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

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

    public function verifyLogin(Request $request, $token)
    {
        $player = Player::where('token', $token)->firstOrFail();
        abort_unless($request->hasValidSignature() && $token, 401);

        Auth::login($player->user);
        if ($player->user->getRedirectRoute() === 'admin') {
            return redirect('dashboard');
        }
        return redirect()->route('dashboard-player', ['player' => $player]);
    }
}
