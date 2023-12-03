<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    protected UserRepository $userRepository;
    /**
     * Constructor of the resource.
     */
    public function __construct(UserRepository $userrepository)
    {
        $this->userRepository=$userrepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(Auth::user()->can('viewAny',User::class)){
            $users=$this->userRepository->findAll();
            if($users){
                return response()->json([
                    "sucess"=>true,
                    "data"=>$users,
                    "message"=>"Liste des utilisateurs"
                ],Response::HTTP_OK);
            }
            return response()->json([
                "sucess"=>false,
                "message"=>"Pas d'utilisateur trouvé"
            ],Response::HTTP_NOT_FOUND);
        }
        else{
            return response()->json([
                "sucess"=>false,
                "message"=>"Pas autorisé"
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
    public function store(UserRequest $request)
    {
        //
        if(Auth::user()->can('create',User::class)){
            $user=$this->userRepository->create($request->all());
            if($user){
                return response()->json([
                    "sucess"=>true,
                    "data"=>$user,
                    "message"=>"User inseré"
                ],Response::HTTP_CREATED);
            }
            return response()->json([
                "sucess"=>false,
                "message"=>"Erreur lors de l'insertion d'un user"
            ],Response::HTTP_NOT_FOUND);
        }
        else{
            return response()->json([
                "sucess"=>false,
                "message"=>"Pas autorisé"
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
            $user=$this->userRepository->findById($id);
            if($user){
                return response()->json([
                    "sucess"=>true,
                    "data"=>$user,
                    "message"=>"User trouvé"
                ],Response::HTTP_OK);
            }
            return response()->json([
                "sucess"=>false,
                "message"=>"User inexistant"
            ],Response::HTTP_NOT_FOUND);
        }
        else{
            return response()->json([
                "sucess"=>false,
                "message"=>"Pas autorisé"
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
            $user=$this->userRepository->update($request->all(),$id);
            if($user){
                return response()->json([
                    "sucess"=>true,
                    "data"=>$user,
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
                "message"=>"Pas autorisé"
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
            $user=$this->userRepository->delete($id);
            if($user>0){
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
                "message"=>"Pas autorisé"
            ],Response::HTTP_UNAUTHORIZED);
        }

    }
}
