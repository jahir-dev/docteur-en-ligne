<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Medecin;
use App\Models\Tag;
use App\Models\Specialite;

class PostMedecinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "hello";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check if tags' ids are provided and fetch models from database into array $tags
        /*
            {
                "post" : "id",
                "medecin" : "id",
                "reponse" : ""
            }
        */
        if($request->post && $request->medecin && $request->reponse ){
            $post_id = $request->post;
            $post = Post::find($post_id);
            if(!$post){
                return response('Post non trouvé. '. $post_id , 404)
                  ->header('Content-Type', 'text/plain');
            }

            $medecin_id = $request->medecin;
            $medecin = Medecin::find($medecin_id);
            if(!$medecin){
                return response('Medecin non trouvé. action non autorisée. '. $medecin_id , 404)
                  ->header('Content-Type', 'text/plain');
            }
            
            $reponse = $request->reponse;
            $post->medecins()->save($medecin,['reponse' => $reponse]);

            return response('Reponse ajoutée.' , 200)
                  ->header('Content-Type', 'text/plain');
        }else{
            return response('Veuillez remplir tous les champs.', 400)
                  ->header('Content-Type', 'text/plain');
        }

        return response('Une erreur s\'est produite, veuillez reessayer.' , 400)
                  ->header('Content-Type', 'text/plain');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
