<?php

namespace App\Repositories;

use App\Helpers\ToolBox;
use App\Models\Article;
use App\Models\Pays;
use App\Repositories\BaseRepository;
use App\Models\Categorie;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Html2Text\Html2Text;


abstract class FrontEndRepository 
{
    protected $perpageweb=20;
    protected $perpagemobile=10;

    public static function getCMRNews($cam) {

        if(Cache::has($cam)){
            return Cache::get($cam)->take(100);
        }
        Cache::remember($cam, now()->addHour(1),function(){
            return Article::where('articles.pays_code',$cam)->where('dateparution','<=', now())->orderByDesc('dateparution')
               ->leftJoin('pays','pays.code','=','articles.pays_code')
               ->leftJoin('rubriques','rubriques.id','=','articles.rubrique_id')
               ->select('*')->take(5);
       });
        return Cache::get($cam)->take(100);
        
    }
    public static  function getOtherNews($orther) {
        if(Cache::has($orther)){
            return Cache::get($orther)->take(100);
        }
        Cache::remember($orther, now()->addHour(1),function(){
            return Article::where('articles.pays_code','<>',$orther)->where('dateparution','<=', now())->orderByDesc('dateparution')
               ->leftJoin('pays','pays.code','=','articles.pays_code')
               ->leftJoin('rubriques','rubriques.id','=','articles.rubrique_id')
               ->select('*')->take(5);
       });
        return Cache::get($cam)->take(100);
    }
    public function findAll(){
        if($article=Cache::get('article-list')){
            return $article;
        }
        $article=Article::orderBy('dateparution','desc')->paginate(100);
        Cache::set('article-list',$article,Carbon::now()->addMinute(60));
        return $article;
    }

}
