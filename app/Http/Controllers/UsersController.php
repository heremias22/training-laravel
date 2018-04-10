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

}
