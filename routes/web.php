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
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'gamesList'])->name('welcome');

Route::get('dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::get('dashboard-player', [DashboardController::class, 'dashboardPlayer'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard-player');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/images/{imageName}', [ImageController::class, 'show'])->name('image.show');
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
    Route::post('/player/{player}/{fase}/show', [PlayerGameController::class, 'toggle'])->name('player.show');
});
require __DIR__ . '/auth.php';
