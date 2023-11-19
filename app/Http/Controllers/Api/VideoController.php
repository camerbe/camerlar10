<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VideoController extends Controller
{
    protected VideoRepository $videoRepository;
    /**
     * Display a listing of the resource.
     */
    public function __construct(VideoRepository $videorepository)
    {
        $this->videoRepository=$videorepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $videos=$this->videoRepository->findAll();
        if($videos){
            return response()->json([
                "sucess"=>true,
                "data"=>$videos,
                "message"=>"Liste des vidéos"
            ],Response::HTTP_FOUND);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Pas de vidéo trouvée"
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
        $video=$this->videoRepository->create($request->all());
        if($video){
            return response()->json([
                "sucess"=>true,
                "data"=>$video,
                "message"=>"Vidéo inserée"
            ],Response::HTTP_CREATED);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Erreur lors de l'insertion d'une vidéo"
        ],Response::HTTP_NOT_FOUND);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $video=$this->videoRepository->findById($id);
        if($video){
            return response()->json([
                "sucess"=>true,
                "data"=>$video,
                "message"=>"Vidéo trouvée"
            ],Response::HTTP_OK);
        }
        return response()->json([
            "sucess"=>false,
            "message"=>"Vidéo inexistante"
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
        $video=$this->videoRepository->update($request->except(['id']),$id);
        if($video){
            return response()->json([
                "sucess"=>true,
                "data"=>$video,
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
        $video=$this->videoRepository->delete($id);
        if($video>0){
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
