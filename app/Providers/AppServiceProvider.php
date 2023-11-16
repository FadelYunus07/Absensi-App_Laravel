<?php

namespace App\Providers;

use Telegram\Bot\Api as Telegram;
use TelegramService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(TelegramService::class, function ($app) {
        //     $telegram = new Telegram('<5897949800:AAFdC_iEFxoL1tsPhFbffLqMpfOYyRR6Hxk>'); // Ganti dengan token bot Telegram Anda
        //     return new TelegramService($telegram);
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin',function($user){
            return $user->role == 'admin';
        });

        Gate::define('guru',function($user){
            return $user->role == 'guru';
        });
        
        Gate::define('siswa',function($user){
            return $user->role == 'siswa';
        });

        Paginator::useBootstrap();
    }
}
