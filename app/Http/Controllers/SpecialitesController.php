<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialite;
use App\Models\Tag;

class SpecialitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $specialite = Specialite::with('tags')->get();
        return $specialite;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

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
                "label" : "name",
                "tags" : ["name","name"..]
            }
        */
        if($request->tags){
            $tags_ids = $request->tags;
            //$tags = Tag::find($tags_ids);
            $tags = [];
            foreach ($tags_ids as $tagId){
                $tag = Tag::find($tagId);
                if($tag){
                    $tags [] = $tag;
                }else{
                    return response('Tag not found, Bad tag ID : '. $tagId , 404)
                  ->header('Content-Type', 'text/plain');
                }
                
            }
        }else{
            return response('No tags given , valid tags ids expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }
        //make sure the $tags array is not empty
        if (empty($tags)){
            return response('No tags given , valid tags ids expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }
        //check the label
        if(!$request->label){
            return response('No label , a valid specialite label is expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }
        //check duplication of specialité
        $specialite = Specialite::whereLabel($request->label)->first();
        if($specialite){
            return response('Duplicated, specialité already exist', 200)
                  ->header('Content-Type', 'text/plain');
        }
        //create specialité and associate its tags
        $specialite = new Specialite();
        $specialite->label = $request->label;
        $specialite->save();
        $specialite->tags()->saveMany($tags);
        return response('Specialite created',200)
                ->header('Content-Type','text/plain');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
