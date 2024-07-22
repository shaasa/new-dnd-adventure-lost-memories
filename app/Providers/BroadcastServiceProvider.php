<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Log::info('BroadcastServiceProvider boot method called');
        Broadcast::routes(['middleware' => ['web', 'auth']]);
        require base_path('routes/channels.php');
    }
}
