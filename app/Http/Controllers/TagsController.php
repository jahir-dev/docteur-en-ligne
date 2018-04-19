<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Specialite;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $tags = DB::table('tags')->orderBy('created_at', 'desc')->get();
        return $tags;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check the label
        if(!$request->label){
            return response('No label , a valid tag label is expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }
        //check duplication of specialité
        $tag = Tag::whereLabel($request->label)->first();
        if($tag){
            return response('Duplicated, tag already exist', 200)
                  ->header('Content-Type', 'text/plain');
        }
        //create the tag
        $tag = new Tag();
        $tag->label = $request->label;
        $tag->save();
        return response('Tag created',200)
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
        $tag = Tag::find($id);
        //check if tag exist
        if(!$tag){
            return response('Tag not found, Bad tag ID : '. $id , 404)
                  ->header('Content-Type', 'text/plain; charset=utf8')
                  ->header('charset','utf8');
        }
        
        return $tag;
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
        $tag = Tag::find($id);
        //check if tag exist
        if(!$tag){
            return response('Tag not found, Bad tag ID : '. $id , 404)
                  ->header('Content-Type', 'text/plain; charset=utf8')
                  ->header('charset','utf8');
        }
        //check the label
        if(!$request->label){
            return response('No label , a valid tag label is expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }
        //check duplication of specialité
        $tagLabel = Tag::whereLabel($request->label)->first();
        if($tagLabel){
            return response('Duplicated, tag already exist', 200)
                  ->header('Content-Type', 'text/plain');
        }
        
        $tag->label = $request->label;
        $tag->save();
        return response('Success, tag updated',200)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialites = Specialite::whereHas('tags', function ($query) use ($id) {
            $query->where('tag_id', '=', $id);
        })->get()->first();

        if(!empty($specialites)){
            return response('Error, tag associated to specialites', 400)
                  ->header('Content-Type', 'text/plain');
        }
        $tag = Tag::find($id);
        $tag->delete();
        return response('Success, tag deleted', 200)
                  ->header('Content-Type', 'text/plain');
    }
}
