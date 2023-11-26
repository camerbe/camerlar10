<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Pays;
use App\Repositories\BaseRepository;
use App\Models\Categorie;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;



class FrontEndRepository
{
    protected $perpageweb=20;
    protected $perpagemobile=10;

    public function getCMRNews($cam) {
        if(Cache::has($cam)){
            return Cache::get($cam)->take(100);
        }
        Cache::remember($cam, now()->addHour(1),function() use ($cam) {
            return Article::where('articles.pays_code',$cam)->where('dateparution','<=', now())->orderByDesc('dateparution')
               ->leftJoin('pays','pays.code','=','articles.pays_code')
               ->leftJoin('rubriques','rubriques.id','=','articles.rubrique_id')
                ->leftJoin('categories','categories.id','=','rubriques.categorie_id')
               ->select('*')->take(100);
       });
        return Cache::get($cam)->take(100);
    }
    public  function getOtherNews($orther) {
        if(Cache::has($orther)){
            return Cache::get($orther)->take(100);
        }
        Cache::remember($orther, now()->addHour(1),function() use ($orther) {
            return Article::where('articles.pays_code','<>',$orther)->where('dateparution','<=', now())->orderByDesc('dateparution')
               ->leftJoin('pays','pays.code','=','articles.pays_code')
               ->leftJoin('rubriques','rubriques.id','=','articles.rubrique_id')
                ->leftJoin('categories','categories.id','=','rubriques.categorie_id')
               ->select('*')->take(100);
       });
        return Cache::get($orther)->take(100);
    }
    public  function getNewsBySlug($slug) {

        $article= Article::where('slug',$slug)->increment('hit');
        return Article::where('slug',$slug)
            ->leftJoin('pays','pays.code','=','articles.pays_code')
            ->leftJoin('rubriques','rubriques.id','=','articles.rubrique_id')
            ->leftJoin('categories','categories.id','=','rubriques.categorie_id')
            ->select('*')->get();
    }
    public function getCountrySameRubrique($pays,$rubrique)
    {

        if(Cache::has($pays.$rubrique)){
            return Cache::get($rubrique)->take(5);
        }
        Cache::remember($pays.$rubrique,now()->addHour(1),function() use($pays,$rubrique){
            return Article::where([
                ['rubrique_id',$rubrique],
                ['pays_code',$pays],
                ['dateparution','<=', Carbon::now()],
            ])->orderByDesc('dateparution')
                ->select('*')->take(5)->get();
        });
        /*Cache::remember($rubrique, now()->addHour(1),function() use ($rubrique) {
            return Article::where('articles.rubrique_id',$rubrique)->where('dateparution','<=', now())->orderByDesc('dateparution')
                ->leftJoin('pays','pays.code','=','articles.pays_code')
                ->leftJoin('categories','categories.id','=','rubriques.categorie_id')
                ->leftJoin('rubriques','rubriques.id','=','articles.rubrique_id')
                ->select('*')->take(5)->get();
        });*/
        return Cache::get($pays.$rubrique)->take(5);

    }
    public function mostReaded(){
        $cache="mostReaded";
        if(Cache::has($cache)){
            return Cache::get($cache)->take(5);
        }
        Cache::remember($cache,Carbon::now()->addHour(24),function(){
            return Article::where([
                ['dateparution', '<=', Carbon::now()],
            ])->orderByDesc('hit')->take(5)->get();
        });
        return Cache::get($cache)->take(5);
    }


}
