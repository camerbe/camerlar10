<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Auth;
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
        if(Auth::user()->can('viewAny',User::class)){
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
        else{
            return response()->json([
                "sucess"=>false,
                "message"=>"Pas autorisé à lister les rôles"
            ],Response::HTTP_UNAUTHORIZED);
        }


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
        if(Auth::user()->can('create',User::class)){
            $role=$this->roleRepository->create($request->all());
            if($role){
                return response()->json([
                    "success"=>true,
                    "data"=>$role,
                    "message"=>"Rôle inseré"
                ],Response::HTTP_CREATED);
            }
            return response()->json([
                "success"=>false,
                "message"=>"Erreur lors de l'insertion d'un rôle"
            ],Response::HTTP_NOT_FOUND);
        }
        else{
            return response()->json([
                "success"=>false,
                "message"=>"Pas autorisé à insérer un rôle"
            ],Response::HTTP_NOT_FOUND);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        if(Auth::user()->can('view',User::class)){
            $role=$this->roleRepository->findById($id);
            if($role){
                return response()->json([
                    "success"=>true,
                    "data"=>$role,
                    "message"=>"Rôle trouvé"
                ],Response::HTTP_OK);
            }
            return response()->json([
                "success"=>false,
                "message"=>"Rôle inexistant"
            ],Response::HTTP_NOT_FOUND);
        }
        else{
            return response()->json([
                "success"=>false,
                "message"=>"Pas autorisé à éditer un rôle"
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
    public function update(Request $request,  $id)
    {
        //
        if(Auth::user()->can('update',User::class)){
            $role=$this->roleRepository->update($request->except(['id']),$id);
            if($role){
                return response()->json([
                    "success"=>true,
                    "data"=>$role,
                    "message"=>"Mise à jour effectuée"
                ],Response::HTTP_OK);
            }
            return response()->json([
                "success"=>false,
                "message"=>"Erreur survenue lors de la mise à jour"
            ],Response::HTTP_NOT_FOUND);
        }
        else{
            return response()->json([
                "success"=>false,
                "message"=>"Pas autorisé à mettre un rôle à jour"
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
            $role=$this->roleRepository->delete($id);
            if($role>0){
                return response()->json([
                    "success"=>true,
                    "message"=>"Suppression réussie"
                ],Response::HTTP_OK);
            }
            return response()->json([
                "success"=>false,
                "message"=>"Une erreur s'est produite..."
            ],Response::HTTP_NOT_FOUND);
        }
        else{
            return response()->json([
                "success"=>false,
                "message"=>"Pas autorisé à supprimer un rôle"
            ],Response::HTTP_UNAUTHORIZED);
        }

    }
}
