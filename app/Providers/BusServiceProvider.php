<?php
namespace App\Providers;

use App\Commands\Command;
use Illuminate\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;
use App\Handlers\Commands\CommandHandler;

class BusServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @param  \Illuminate\Bus\Dispatcher  $dispatcher
     * @return void
     */
    public function boot(Dispatcher $dispatcher)
    {
        $dispatcher->map([
            Command::class => CommandHandler::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
