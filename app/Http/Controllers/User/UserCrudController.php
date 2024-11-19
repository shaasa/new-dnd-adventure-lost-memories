<?php

namespace App\Http\Controllers\User;

use App\Domains\User\Requests\UserCreateRequest;
use App\Domains\User\Requests\UserUpdateRequest;
use App\Domains\User\Services\UserService;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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

        $user = Auth::user();
        $service->create($request);
        $gameId = $request->get('game_id');
        $players = User::inGame($gameId)->get();
        $users =  User::isPlayer()->notInGame($gameId)->get();
        $authToken = $user?->createToken('authToken')->plainTextToken;
        return view('game', ['game' => Game::find($gameId), 'players' => $players, 'users' => $users, 'authToken' => $authToken]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): ?User
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request,User $user, UserService $service): void
    {
        $service->update($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        User::find($id)?->delete();
    }
}
