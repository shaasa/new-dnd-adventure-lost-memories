<?php

use App\Domains\Games\Http\Controllers\GameController;
use App\Domains\Players\Http\Controllers\PlayerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'gamesList'])->name('welcome');

Route::get('dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/images/{imageName}', [ImageController::class, 'show'])->name('image.show');
Route::get('verify-login/{token}', [AuthController::class, 'verifyLogin'])->name('verify-login');

Route::prefix('admin')->group(function () {
    Route::post('/game/insert', [GameController::class, 'insert'])->name('game.insert');
    Route::put('/game/{game_id}/update', [GameController::class, 'update'])->name('game.update');
    Route::get('/game/{game}', [GameController::class, 'page'])->name('game.page');
    Route::post('/player/insert', [PlayerController::class, 'insert'])->name('player.insert');
    Route::put('/player/{player_id}/update', [PlayerController::class, 'update'])->name('player.update');
    Route::put('/player/{player}/refreshToken', [PlayerController::class, 'refreshToken'])->name('player.refresh-token');
    Route::put('/player/{player}/sendToken', [PlayerController::class, 'sendToken'])->name('player.send-token');
    Route::post('/player/{player_id}/discord', [PlayerController::class, 'discord'])->name('player.discord');
    Route::delete('/player/{player_id}/delete', [PlayerController::class, 'delete'])->name('player.delete');
})->middleware(['auth.admin', 'verified']);
require __DIR__ . '/auth.php';
