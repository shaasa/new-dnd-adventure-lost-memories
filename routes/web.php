<?php

use App\Domains\Game\Controller\GameController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/images/{imageName}', [ImageController::class, 'show'])->name('image.show');

Route::post('game/insert', [GameController::class, 'insert'])
     ->middleware(['auth', 'verified'])
     ->name('game.insert');

require __DIR__.'/auth.php';
