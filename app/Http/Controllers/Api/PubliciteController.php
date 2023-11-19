<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PubliciteRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PubliciteController extends Controller
{
    protected PubliciteRepository $publiciteRepository;
    /**
     * Display a listing of the resource.
     */
    public function __construct(PubliciteRepository $publiciterepository)
    {
        $this->publiciteRepository=$publiciterepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $publicites=$this->publiciteRepository->findAll();
        if($publicites){
            return response()->json([
                "sucess"=>true,
                "data"=>$publicites,
                "message"=>"Liste des publicité"
            ],Response::HTTP_FOUND);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Pas de publicité trouvée"
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
        $publicite=$this->publiciteRepository->create($request->all());
        if($publicite){
            return response()->json([
                "sucess"=>true,
                "data"=>$publicite,
                "message"=>"Publicité inserée"
            ],Response::HTTP_CREATED);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Erreur lors de l'insertion d'une publicité"
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $publicite=$this->publiciteRepository->findById($id);
        if($publicite){
            return response()->json([
                "sucess"=>true,
                "data"=>$publicite,
                "message"=>"Publicité trouvée"
            ],Response::HTTP_OK);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Publicité inexistante"
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
        $publicite=$this->publiciteRepository->update($request->except(['id']),$id);
        if($publicite){
            return response()->json([
                "sucess"=>true,
                "data"=>$publicite,
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
        $publicite=$this->publiciteRepository->delete($id);
        if($publicite>0){
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
