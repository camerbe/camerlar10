<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::get('refresh', [AuthController::class, 'refreshToken']);
    Route::get('logout', [AuthController::class, 'logout']);

    Route::apiResources([
        "articles"=>\App\Http\Controllers\Api\ArticleController::class,
        "categories"=>\App\Http\Controllers\Api\CategorieController::class,
        "publicites"=>\App\Http\Controllers\Api\PubliciteController::class,
        "roles"=>\App\Http\Controllers\Api\RoleController::class,
        "rubriques"=>\App\Http\Controllers\Api\RubriqueController::class,
        "typepubs"=>\App\Http\Controllers\Api\TypePubController::class,
        "videos"=>\App\Http\Controllers\Api\VideoController::class,
        "users"=>\App\Http\Controllers\Api\UserController::class,
        
    ]);
});

Route::post('login', [AuthController::class, 'login']);
