<?php

use App\Domains\Games\Http\Controllers\GameController;
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


Route::prefix('admin')->group(function () {
Route::post('/game/insert', [GameController::class, 'insert'])
     ->name('game.insert');
Route::post('/game/update', [GameController::class, 'update'])
     ->name('game.update');

Route::get('/games/{game}', [GameController::class, 'page'])
     ->name('game.page');
})->middleware(['auth.admin', 'verified']);
require __DIR__.'/auth.php';
