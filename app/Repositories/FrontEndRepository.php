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
    public function getNewsSameRubrique($rubrique)
    {

        if(Cache::has($rubrique)){
            return Cache::get($rubrique)->take(5);
        }
        Cache::remember($rubrique, now()->addHour(1),function() use ($rubrique) {
            return Article::where('articles.rubrique_id',$rubrique)->where('dateparution','<=', now())->orderByDesc('dateparution')
                ->leftJoin('pays','pays.code','=','articles.pays_code')
                ->leftJoin('categories','categories.id','=','rubriques.categorie_id')
                ->leftJoin('rubriques','rubriques.id','=','articles.rubrique_id')
                ->select('*')->take(5)->get();
        });
        return Cache::get($rubrique)->take(5);

    }
    /*public function findAll(){
        if($article=Cache::get('article-list')){
            return $article;
        }
        $article=Article::orderBy('dateparution','desc')->paginate(100);
        Cache::set('article-list',$article,Carbon::now()->addMinute(60));
        return $article;
    }*/

}
