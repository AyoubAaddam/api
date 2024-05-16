<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{

    //GET
    function index(){
        $posts=Post::all();
        if($posts){
           return response()->json(['data'=>$posts],200);
        }else{
            return response()->json(['data'=>'No posts'],404);
        }

    }

    //GET /id
    function show(Post $post){

    }

//post
    function store(Request $request){

    }

    //PUT /id
    function update(Request $request, Post $post) {

    }

    //DELETE /ID
    function destroy(Request $request, Post $post) {

    }

}
