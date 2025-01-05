<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\User\UserCrudController;
use App\Http\Controllers\User\UserDiscordController;
use App\Http\Controllers\User\UserGameController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Broadcast::routes();
});

Route::get('/broadcasting/auth', function (Request $request) {
    $user = Auth::user();
    Log::info('Broadcasting auth route');
    if ($user) {
        $response =
            [
                'id' => $user->id,
                'user_info' => [
                    'name' => $user->name,
                ]
            ];
        return new JsonResponse($response);
    }

    return new JsonResponse([], 403);
})->middleware(['auth'])->name('broadcast.auth');

Route::get('/', [WelcomeController::class, 'gamesList'])->name('welcome');
//Dashboard admin
Route::get('dashboard', [DashboardController::class, 'dashboard'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard');

//Dashboard player
Route::get('dashboard-player/{game}', [DashboardController::class, 'dashboardPlayer'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard.player');

Route::view('profile', 'profile')
     ->middleware(['auth'])
     ->name('profile');

Route::get('/images/{imageName}', [ImageController::class, 'show'])->name('image.show');
Route::get('/images/sheet/{imageName}', [ImageController::class, 'showSheet'])->name('image.sheet.show');
Route::get('verify-login/{token}/{game}', [AuthController::class, 'verifyLogin'])->name('verify-login');

Route::prefix('admin')->middleware(['auth.admin', 'verified'])->group(function () {
    Route::post('/game/insert', [GameController::class, 'store'])->name('game.insert');
    Route::post('/game/{game_id}/update', [GameController::class, 'update'])->name('game.update');
    Route::get('/game/{game}', [GameController::class, 'page'])->name('game.page');

    Route::resource('player', UserCrudController::class);
    Route::post('/player/game/attach', [UserGameController::class, 'attachUserGame'])->name('player.game.attach');
    Route::get('/player/{user}/refreshToken', [UserLoginController::class, 'refreshToken'])->name('player.refresh-token');
    Route::get('/player/{user}/{game}/sendToken', [UserLoginController::class, 'sendToken'])->name('player.send-token');
    Route::post('/player/{user}/discord/sendMessage', [UserDiscordController::class, 'sendDiscordMessage'])->name('player.discord.send-message');
    Route::get('/player/{user}/{fase}/{game}/show', [UserGameController::class, 'toggle'])->name('player.show');
    Route::get('/player/{user}/{game}/delete', [UserGameController::class, 'delete'])->name('player.delete');
});
require __DIR__ . '/auth.php';

// File: ./routes/web.php

/*Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/', 'Auth\LoginController@login');
Route::view('/', 'signin')->middleware('guest')->name('login');*/
