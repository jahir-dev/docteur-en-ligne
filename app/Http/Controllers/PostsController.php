<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Specialite;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('tags','medecins')->get();
        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
            {
                "titre" : "name",
                "description" : "description",
                "tags" : ["id","id"..]
            }
        */
        //check the title
        if(!$request->titre){
            return response('No title , a valid post title is expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }
        //check the discription
        if(!$request->description){
            return response('No description , a valid post description is expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }

        if($request->tags){
            $tags_ids = $request->tags;
            //$tags = Tag::find($tags_ids);
            $tags = [];

            // foreach ($tags_ids as $tagId){
            //     $tag = Tag::find($tagId);
            //     var_dump($tag);
            // }
            // die('end');

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
            return response('No tags given , valid tags ids are expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }
        //make sure the $tags array is not empty
        if (empty($tags)){
            return response('No tags given , valid tags ids expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }
        
        //Ajout du post
        $post = new Post();
        $post->titre = $request->titre;
        $post->description = $request->description;
        $post->save();
        $post->tags()->saveMany($tags);
        return response('Post created',200)
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
        $post = Post::where('id',$id)->with('medecins','tags')->first();
        
        if (!$post){
            return response('Post not found, Bad ID : '. $id , 404)
                  ->header('Content-Type', 'text/plain; charset=utf8')
                  ->header('charset','utf8');
        }
        return $post;
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
        //find post
        $post = Post::where('id',$id)->first();        
        if (!$post){
            return response('Post not found, Bad ID : '. $id , 404)
                  ->header('Content-Type', 'text/plain; charset=utf8')
                  ->header('charset','utf8');
        }
         //check the title
         if(!$request->titre){
            return response('No title , a valid post title is expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }
        //check the discription
        if(!$request->description){
            return response('No description , a valid post description is expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }
        if($request->tags){
            $tags_ids = $request->tags;
            //$tags = Tag::find($tags_ids);
            $tags = [];
            foreach ($tags_ids as $tagId){
                $tag = Tag::find($tagId)->first();
                if($tag){
                    $tags [] = $tag;
                }else{
                    return response('Tag not found, Bad tag ID : '. $tagId , 404)
                  ->header('Content-Type', 'text/plain');
                }   
            }
        }else{
            return response('No tags given , valid tags ids are expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }
        //make sure the $tags array is not empty
        if (empty($tags)){
            return response('No tags given , valid tags ids expected.', 400)
                  ->header('Content-Type', 'text/plain');
        }
        
        //update post
        $post->titre = $request->titre;
        $post->description = $request->description;
        $post->save();
        $post->tags()->sync($tags);
        return response('Post created',200)
                ->header('Content-Type','text/plain');
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
