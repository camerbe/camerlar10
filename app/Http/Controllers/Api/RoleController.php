<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    protected $roleRepository;
    /**
     * Constructor.
     */
    public function __construct(RoleRepository $rolerepository)
    {
        $this->roleRepository=$rolerepository;
    }
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        //
        $roles=$this->roleRepository->findAll();
        if($roles){
            return response()->json([
                "sucess"=>true,
                "data"=>$roles,
                "message"=>"Liste des rôles"
            ],Response::HTTP_FOUND);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Pas de rôle trouvé"
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
        $role=$this->roleRepository->create($request->all());
        if($role){
            return response()->json([
                "sucess"=>true,
                "data"=>$role,
                "message"=>"Rôle inseré"
            ],Response::HTTP_CREATED);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Erreur lors de l'insertion d'un rôle"
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $role=$this->roleRepository->findById($id);
        if($role){
            return response()->json([
                "sucess"=>true,
                "data"=>$role,
                "message"=>"Rôle trouvé"
            ],Response::HTTP_OK);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Rôle inexistant"
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
        $role=$this->roleRepository->update($request->except(['id']),$id);
        if($role){
            return response()->json([
                "sucess"=>true,
                "data"=>$role,
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
        $role=$this->roleRepository->delete($id);
        if($role>0){
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
