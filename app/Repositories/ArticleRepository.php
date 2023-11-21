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


class ArticleRepository extends BaseRepository
{
    public function __construct(Article $article)
    {
        $this->model=$article;
    }

    public function findById($id)
    {
        return parent::findById($id); // TODO: Change the autogenerated stub
    }

    public function delete($id)
    {
        return parent::delete($id); // TODO: Change the autogenerated stub
    }

    public function update(array $input, $id)
    {

        return parent::update($input, $id); // TODO: Change the autogenerated stub
    }

    public function create(array $input)
    {
        $pays = Pays::whereCode($input["pays_code"])->first();
        $titre = $input["titre"];
        $titre = Str::contains(Str::lower($titre), Str::lower($pays->pays)) ? $titre : Str::slug($pays->pays . ' ' . $titre);
        $titre = Str::contains(Str::lower($titre), Str::lower($pays->country)) ? $titre : Str::slug($titre .' ' .$pays->country) ;

        $html=new Html2Text($input["article"]);
        $articletotext=$html->getText();
        $input["chapeau"] = Str::limit($html->getText(), 160);

        $data= parent::create($input); // TODO: Change the autogenerated stub
        return parent::findById($data->id);
    }
    public function findAll(){
        if($article=Cache::get('admin-article-list')){
            return $article;
        }
        $article=Article::orderBy('dateparution','desc')->paginate(100);
        Cache::set('admin-article-list',$article,Carbon::now()->addMinute(60));
        return $article;
    }

}
