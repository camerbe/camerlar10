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
        $this->TypePubRepoRegister();
        $this->CategorieRepoRegister();
        $this->RubriqueRepoRegister();
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
    public function TypePubRepoRegister(){
        return $this->app->bind('App\Repositories\BaseRepository','App\Repositories\TypePubRepository');
    }
    public function CategorieRepoRegister(){
        return $this->app->bind('App\Repositories\BaseRepository','App\Repositories\CategorieRepository');
    }
    public function RubriqueRepoRegister(){
        return $this->app->bind('App\Repositories\BaseRepository','App\Repositories\RubriqueRepository');
    }
}
