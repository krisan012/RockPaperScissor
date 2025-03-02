<?php

namespace App\Providers;

use App\Interfaces\PlayerInterface;
use App\Players\RandomComputerPlayer;
use App\Rules\RuleBook;
use App\Services\GameService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PlayerInterface::class, function ($app) {
            return new RandomComputerPlayer();
        });

        $this->app->singleton(RuleBook::class, function ($app){
            return new RuleBook();
        });

        $this->app->singleton(GameService::class, function ($app) {
            return new GameService(
                $app->make(PlayerInterface::class),
                $app->make(RuleBook::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
