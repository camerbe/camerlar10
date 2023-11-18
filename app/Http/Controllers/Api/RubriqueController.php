<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\RubriqueRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RubriqueController extends Controller
{
    protected RubriqueRepository  $rubriquerepository;
    /**
     * Constructor of the resource.
     */
    public function __construct(RubriqueRepository $rubriquerepository)
    {
        $this->rubriquerepository=$rubriquerepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rubriques=$this->rubriquerepository->findAll();
        if($rubriques){
            return response()->json([
                "sucess"=>true,
                "data"=>$rubriques,
                "message"=>"Liste des rubriques"
            ],Response::HTTP_FOUND);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Pas de rubrique trouvé"
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

        $rubrique=$this->rubriquerepository->create($request->all());
        if($rubrique){
            return response()->json([
                "sucess"=>true,
                "data"=>$rubrique,
                "message"=>"Rubrique inserée"
            ],Response::HTTP_CREATED);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Erreur lors de l'insertion d'une rubrique"
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $rubrique=$this->rubriquerepository->findById($id);
        if($rubrique){
            return response()->json([
                "sucess"=>true,
                "data"=>$rubrique,
                "message"=>"Rubrique trouvée"
            ],Response::HTTP_OK);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Rubrique inexistante"
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
    public function update(Request $request,  $id)
    {
        //
        $rubrique=$this->rubriquerepository->update($request->except(['id']),$id);
        if($rubrique){
            return response()->json([
                "sucess"=>true,
                "data"=>$rubrique,
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
        $rubrique=$this->rubriquerepository->delete($id);
        if($rubrique>0){
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
