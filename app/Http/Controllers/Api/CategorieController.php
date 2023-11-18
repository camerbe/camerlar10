<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CategorieRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategorieController extends Controller
{
    protected CategorieRepository $categorieRepository;
    /**
     * Contructor of the resource.
     */
    public function __construct(CategorieRepository $categorierepository)
    {
        $this->categorieRepository=$categorierepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories=$this->categorieRepository->findAll();
        if($categories){
            return response()->json([
                "sucess"=>true,
                "data"=>$categories,
                "message"=>"Liste des Catégories"
            ],Response::HTTP_FOUND);
        }
        return response()->json([
                "sucess"=>false,
                "message"=>"Pas de catégorie trouvé"
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories=$this->categorieRepository->findAll();
        if($categories){
            return response()->json([
                "sucess"=>true,
                "data"=>$categories,
                "message"=>"Liste des Catégories"
            ],Response::HTTP_FOUND);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Pas de Catégorie trouvé"
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $categorie=$this->categorieRepository->create($request->all());
        if($categorie){
            return response()->json([
                "sucess"=>true,
                "data"=>$categorie,
                "message"=>"Catégorie inserée"
            ],Response::HTTP_CREATED);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Erreur lors de l'insertion d'une catégorie"
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $categorie=$this->categorieRepository->findById($id);
        if($categorie){
            return response()->json([
                "sucess"=>true,
                "data"=>$categorie,
                "message"=>"Catégorie trouvée"
            ],Response::HTTP_OK);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Catégorie inexistante"
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
        $categorie=$this->categorieRepository->update($request->all(),$id);
        if($categorie){
            return response()->json([
                "sucess"=>true,
                "data"=>$categorie,
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
        $categorie=$this->categorieRepository->delete($id);
        if($categorie>0){
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