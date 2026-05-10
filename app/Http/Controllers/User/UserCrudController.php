<?php

namespace App\Http\Controllers\User;

use App\Domains\User\Requests\UserCreateRequest;
use App\Domains\User\Requests\UserUpdateRequest;
use App\Domains\User\Services\UserService;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserCrudController extends Controller
{
        /**
     * Show the form for creating a new resource.
     */
    public function create(UserCreateRequest $request, UserService $service): RedirectResponse
    {
        return redirect()->route('user.page');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request, UserService $service)
    {

        $service->create($request);
        $gameId = $request->get('game_id');
        $players = User::inGame($gameId)->get();
        $users = User::isPlayer()->notInGame($gameId)->get();
        return view('game', ['game' => Game::find($gameId), 'players' => $players, 'users' => $users]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $player)
    {
        return view('players.show', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $player, UserService $service): RedirectResponse
    {
        $service->update($request, $player);
        return redirect()->route('player.show', $player->id)->with('success', 'Dati aggiornati.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        User::find($id)?->delete();
    }
}
