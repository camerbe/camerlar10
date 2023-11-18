<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Typepub;
use App\Repositories\TypePubRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypePubController extends Controller
{
    protected TypePubRepository $typepubRepository;
    /**
     * Constructor  of the resource.
     */
    public function __construct(TypePubRepository $typepubrepository)
    {
        $this->typepubRepository=$typepubrepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $typepub=$this->typepubRepository->findAll();
        if($typepub){
            return response()->json([
                "sucess"=>true,
                "data"=>$typepub,
                "message"=>"Liste des TypePubs"
            ],Response::HTTP_FOUND);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Pas de typepub trouvé"
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
        $typepub=$this->typepubRepository->create($request->all());
        if($typepub){
            return response()->json([
                "sucess"=>true,
                "data"=>$typepub,
                "message"=>"TypPub inseré"
            ],Response::HTTP_CREATED);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Erreur lors de l'insertion d'un typepub"
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $typepub=$this->typepubRepository->findById($id);
        if($typepub){
            return response()->json([
                "sucess"=>true,
                "data"=>$typepub,
                "message"=>"TypePub trouvé"
            ],Response::HTTP_OK);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"TypePub inexistant"
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
        $typepub=$this->typepubRepository->update($request->all(),$id);
        if($typepub){
            return response()->json([
                "sucess"=>true,
                "data"=>$typepub,
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
        $typepub=$this->typepubRepository->delete($id);
        if($typepub>0){
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
