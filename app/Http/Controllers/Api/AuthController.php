<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as Reponse;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;
use App\Models\Role;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        //$token = Auth::attempt($credentials);
        $token = JWTAuth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Pas autorisé',
            ],Reponse::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();

        return response()->json([
            'success' => true,
            'data' => $user,
            'token' => $token,
            'role'=>Role::find($user->id)->role,
            'expiresIn'=> Carbon::now()->addMinute(15),
            'message' => 'Login ok',
        ],Reponse::HTTP_OK);

    }
    public function profile(){
        $usrData=auth()->user();
        return response()->json([
            'success' => true,
            'data'=>$usrData,
            'role'=>Role::find($usrData->id)->role,
            'message'=>"Détails du user",
        ],Reponse::HTTP_OK);
    }
    public function refreshToken(){
        $newToken=\auth()->refresh();
        return \response()->json([
            "success"=>true,
            "data"=>$newToken,
            "message"=>"Nouveau token"
        ],Reponse::HTTP_OK);
    }
    public function logout(){
        \auth()->logout();
        return \response()->json([
            "success"=>true,
            "message"=>"Logout ok"
        ],Reponse::HTTP_OK);
    }
}
