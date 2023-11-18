<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->RoleRepoRegister();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
    public function RoleRepoRegister(){
        return $this->app->bind('App\Repositories\BaseRepository','App\Repositories\RoleRepository');
    }
}
