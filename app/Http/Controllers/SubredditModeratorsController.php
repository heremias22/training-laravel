<?php

namespace App\Http\Controllers;

use App\User;
use App\Subreddit;
use Illuminate\Http\Request;


class SubredditModeratorsController extends Controller
{
    public function store(Request $request, Subreddit $subreddit){
        $username = $request->get('username');
        $user = User::where('username', $username)->first();

        if (!$user) {
            // return with errors
        }
        $subreddit->addModerator($user->id);

        return redirect()->route("subreddits.index")->with("status","New mod ADDED!");
    }

    public function destroy(Subreddit $subreddit, User $user){
        $subreddit->removeModerator($user->id);
        return redirect()->route("subreddits.index")->with("status","mod REMOVED!");
    }
}
