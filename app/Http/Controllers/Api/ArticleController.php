<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    protected ArticleRepository $articleRepository;
    /**
     * Constructor of the resource.
     */
    public function __construct(ArticleRepository $articlerepository)
    {
        $this->articleRepository=$articlerepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $articles=$this->articleRepository->findAll();
        if($articles){
            return response()->json([
                "sucess"=>true,
                "data"=>$articles,
                "message"=>"Liste des articles"
            ],Response::HTTP_FOUND);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Pas d'article trouvé"
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $article=$this->articleRepository->create($request->all());
        if($article){
            return response()->json([
                "sucess"=>true,
                "data"=>$article,
                "message"=>"Article inseré"
            ],Response::HTTP_CREATED);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Erreur lors de l'insertion d'un article"
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $article=$this->articleRepository->findById($id);
        if($article){
            return response()->json([
                "sucess"=>true,
                "data"=>$article,
                "message"=>"Article trouvé"
            ],Response::HTTP_OK);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Article inexistant"
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $article=$this->articleRepository->update($request->all(),$id);
        if($article){
            return response()->json([
                "sucess"=>true,
                "data"=>$article,
                "message"=>"Mise à jour effectuée"
            ],Response::HTTP_OK);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Erreur survenue lors de la mise à jour"
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $article=$this->articleRepository->delete($id);
        if($article>0){
            return response()->json([
                "sucess"=>true,
                "message"=>"Suppression réussie"
            ],Response::HTTP_OK);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Une erreur s'est produite..."
        ],Response::HTTP_NOT_FOUND);
    }
}
