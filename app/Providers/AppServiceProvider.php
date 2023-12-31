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
        $this->PubliciteRepoRegister();
        $this->VideoRepoRegister();
        $this->ArticleRepoRegister();
        $this->FrontEndRepoRegister();
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
    public function PubliciteRepoRegister(){
        return $this->app->bind('App\Repositories\BaseRepository','App\Repositories\PubliciteRepository');
    }
    public function VideoRepoRegister(){
        return $this->app->bind('App\Repositories\BaseRepository','App\Repositories\VideoRepository');
    }
    public function ArticleRepoRegister(){
        return $this->app->bind('App\Repositories\BaseRepository','App\Repositories\ArticleRepository');
    }
    public function FrontEndRepoRegister(){
        return $this->app->bind('App\Repositories\BaseRepository','App\Repositories\FrontEndRepository');
    }
    public function UserRepoRegister(){
        return $this->app->bind('App\Repositories\BaseRepository','App\Repositories\UserRepository');
    }
}
