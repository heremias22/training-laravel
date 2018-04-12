<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CommentsController extends Controller
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
    public function create()
    {
        return view("comment.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Input::get('post_id');
        $post = Post::find($id);

        $this->validate($request, [
            'body' => 'required',
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->creator_id = auth()->user()->id;
        $post->comments()->save($comment);
        //$this->votes()->save($vote);

        /*
        $comment = Comment::create([
        'body' => $request->body,
        'creator_id' => Auth()->user()->id,
        'post_id' => $request->post_id
        ]);
         */

        return redirect()->back()->with("status", "Comment created!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view("comment.edit", compact("comment"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'body' => 'required|min:3',
        ]);

        //$subredditSearch = Subreddit::findOrFail($subreddit->id);
        $comment->update($request->all());

        return redirect()->route("posts.show", [$comment->post()])->with("status", "Comentario Actualizado!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route("posts.show", [$comment->post])->with("status", "Comentario Borrado!");
    }

    public function vote(Request $request)
    {

        $id = Input::get('id');
        $type = Input::get("type");
        $comment = Comment::where("id", $id)->first();

        if ($comment->vote($type)) {
            return response()->json([
                'status' => 'success',
                'points' => $comment->getPoints(),
            ], 201);
        } else {
            return response()->json([
                'status' => 'fail',
            ], 404);
        }
    }

}
