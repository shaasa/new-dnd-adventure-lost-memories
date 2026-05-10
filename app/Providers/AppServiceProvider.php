<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        // Workaround: PHP 8.5 + Laravel 12 - comandi risolti via ContainerCommandLoader
        // non ricevono setLaravel() automaticamente; questo callback lo garantisce.
        $this->app->resolving(Command::class, function (Command $command) {
            $command->setLaravel($this->app);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
