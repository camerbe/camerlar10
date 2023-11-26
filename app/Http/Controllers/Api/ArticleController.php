<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if(Auth::user()->can('create',Article::class)){
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
        else {
            return response()->json([
                "sucess"=>false,
                "message"=>"Pas autorisé à insérer un article"
            ],Response::HTTP_UNAUTHORIZED);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        if(Auth::user()->can('view',User::class)){
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
        else{
            return response()->json([
                "sucess"=>false,
                "message"=>"Pas autorisé à insérer un article"
            ],Response::HTTP_UNAUTHORIZED);
        }

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
        if(Auth::user()->can('update',User::class)){
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
        else{
            return response()->json([
                "sucess"=>false,
                "message"=>"Pas autorisé à mettre à jour un article"
            ],Response::HTTP_UNAUTHORIZED);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        if(Auth::user()->can('delete',User::class)){
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
        else{
            return response()->json([
                "sucess"=>false,
                "message"=>"Pas autorisé à supprimer un article"
            ],Response::HTTP_UNAUTHORIZED);
        }

    }
}
