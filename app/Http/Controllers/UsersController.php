<?php

namespace App\Http\Controllers;
use App\User;
use App\Subreddit;
use Illuminate\Http\Request;

class UsersController extends Controller
{


    public function getProfile(User $user){
        return view("user.profile", compact("user"));
    }

    public function show(User $user)
    {
        return view("user.show", compact("user"));
    }

    public function addModeratorToSubreddit(User $user, Subreddit $subreddit){
        $user->moderadedSubreddits()->attach($subreddit->id);    
        return redirect()->route("subreddits.index")->with("status","New mod ADDED!");

    }

    public function removeModeratorFromSubreddit(User $user, Subreddit $subreddit){
        $user->moderadedSubreddits()->detach($subreddit->id);    
        return redirect()->route("subreddits.index")->with("status","mod REMOVED!");
    }

}
