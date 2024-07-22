<?php

namespace App\Http\Controllers\User;



use App\Domains\User\Actions\GenerateToken;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Game\GameController;
use App\Models\Game;
use App\Models\User;
use App\Notifications\LoginLinkNotification;
use Illuminate\Http\RedirectResponse;



class UserLoginController extends Controller
{

    public function __construct(protected GenerateToken $generateToken)
    {
    }

    public function refreshToken(User $user, Game $game): RedirectResponse
    {
        $user = $this->updateToken($user);
        return redirect()->route('game.page', ['user' => $user, 'game' => $game->id]);
    }

    public function sendToken(User $user, Game $game,)
    {
        try {
            $user = $this->updateToken($user);
            $user->notify(new LoginLinkNotification($game));
        }catch (\Throwable $exception){
            ray($exception->getMessage());
        }
        return app(GameController::class)->page($game);
    }

    protected  function updateToken(User $user): User
    {
        $token = $this->generateToken->execute();
        $user->update(['token' => $token]);
        return $user;
    }

}
