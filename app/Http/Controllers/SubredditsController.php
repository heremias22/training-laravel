<?php

namespace App\Http\Controllers;

use App\Subreddit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubredditsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subreddits = Subreddit::all();
        return view("subreddit.index",compact("subreddits"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("subreddit.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Subreddit $subreddit)
    {
        $this->validate($request, [
            'name' => 'required|unique:subreddits|max:40',
            'description' => 'required',
        ]);

        $subreddit = Subreddit::create([
            'name' => $request->name, 
            'description' => $request->description,
            'creator_id' => Auth::id()
        ]);    
    
        return redirect()->route("subreddits.index")->with("status","Subreddit created!");
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subreddit  $subreddit
     * @return \Illuminate\Http\Response
     */
    public function show(Subreddit $subreddit)
    {
        $subredditShow = Subreddit::findOrFail($subreddit->id);

        return view("subreddit.show", compact("subredditShow"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subreddit  $subreddit
     * @return \Illuminate\Http\Response
     */
    public function edit(Subreddit $subreddit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subreddit  $subreddit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subreddit $subreddit)
    {
        $this->validate($request, [
            'description' => 'required|min:6',
        ]);

        $subredditSearch = Subreddit::findOrFail($subreddit->id);
        $subredditSearch->update($request->all()); 
    
        return redirect()->route("subreddits.index")->with("status","Subreddit Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subreddit  $subreddit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subreddit $subreddit)
    {
        $subredditBorrar = Subreddit::find($subreddit->id);    
        if($subredditBorrar->delete()){
            return redirect()->route("subreddits.index")->with("status","Subreddit borrado!");
        }
    }
}
