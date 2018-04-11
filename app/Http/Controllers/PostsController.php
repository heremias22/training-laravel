<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PostsController extends Controller
{
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view("post.create",compact("id"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
            'name' => 'required|unique:posts|max:100',
            'body' => 'required',
        ]);

        $post = Post::create([
            'name' => $request->name, 
            'body' => $request->body,
            'creator_id' => Auth()->user()->id,
            'subreddit_id' => $request->subreddit_id
            
        ]);    
    
        return redirect()->route("subreddit.main",[$request->subreddit_id])->with("status","Post created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("post.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("post.edit",compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'body' => 'required|min:3',
        ]);

        //$subredditSearch = Subreddit::findOrFail($subreddit->id);
        $comment->update($request->all()); 
    
        return redirect()->route("posts.show", [$post])->with("status","Post Actualizado!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route("subreddit.main",[$post->subreddit])->with("status","Post Borrado!");
    }
    
    public function vote(Request $request){

        $id = Input::get('id');
        $type = Input::get("type");
        $post = Post::where("id",$id)->first();
       

        if($post->vote($type)){
            return response()->json([
                'status' => 'success',
                'points' => $post->getPoints(),
            ], 201);
        } else{
            return response()->json([
                'status' => 'fail'
            ], 404);
        }
    }
        
}

