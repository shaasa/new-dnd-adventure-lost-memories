<?php

use App\Domains\Games\Http\Controllers\GameController;
use App\Domains\Players\Http\Controllers\PlayerCrudController;
use App\Domains\Players\Http\Controllers\PlayerDiscordController;
use App\Domains\Players\Http\Controllers\PlayerGameController;
use App\Domains\Players\Http\Controllers\PlayerLoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Broadcast::routes();

Route::post('/broadcasting/auth', function (Request $request) {
    $user = Auth::user();

    // Debugging la richiesta
    ray($request->all());

    if ($user) {
        $response =
            [
                'id' => $user->id,
                'user_info' => [
                    'name' => $user->name,
                ]
            ];

        Log::info('Authorization response: ' . json_encode($response, JSON_THROW_ON_ERROR));
        return new JsonResponse($response);
    }

    return new JsonResponse([], 403);
});

Route::get('/', [WelcomeController::class, 'gamesList'])->name('welcome');

Route::get('dashboard', [DashboardController::class, 'dashboard'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard');
Route::get('dashboard/{player}/player', [DashboardController::class, 'dashboardPlayer'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard-player');

Route::view('profile', 'profile')
     ->middleware(['auth'])
     ->name('profile');

Route::get('/images/{imageName}', [ImageController::class, 'show'])->name('image.show');
Route::get('/images/sheet/{imageName}', [ImageController::class, 'showSheet'])->name('image.sheet.show');
Route::get('verify-login/{token}', [AuthController::class, 'verifyLogin'])->name('verify-login');

Route::prefix('admin')->middleware(['auth.admin', 'verified'])->group(function () {
    Route::post('/game/insert', [GameController::class, 'insert'])->name('game.insert');
    Route::put('/game/{game_id}/update', [GameController::class, 'update'])->name('game.update');
    Route::get('/game/{game}', [GameController::class, 'page'])->name('game.page');
    Route::post('/player/insert', [PlayerCrudController::class, 'insert'])->name('player.insert');
    Route::put('/player/{player}/update', [PlayerCrudController::class, 'update'])->name('player.update');
    Route::get('/player/{player}/delete', [PlayerCrudController::class, 'delete'])->name('player.delete');
    Route::get('/player/{player}/refreshToken', [PlayerLoginController::class, 'refreshToken'])->name('player.refresh-token');
    Route::get('/player/{player}/sendToken', [PlayerLoginController::class, 'sendToken'])->name('player.send-token');
    Route::post('/player/{player}/discord/sendMessage', [PlayerDiscordController::class, 'sendDiscordMessage'])->name('player.discord.send-message');
    Route::get('/player/{player}/{fase}/show', [PlayerGameController::class, 'toggle'])->name('player.show');
});
require __DIR__ . '/auth.php';



// File: ./routes/web.php


    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/', 'Auth\LoginController@login');
    Route::view('/', 'signin')->middleware('guest')->name('login');
