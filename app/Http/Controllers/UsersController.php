<?php

namespace App\Http\Controllers;
use App\User;
use App\Subreddit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{


    public function getProfile(User $user){
        return view("user.profile", compact("user"));
    }

    public function show(User $user)
    {
        return view("user.show", compact("user"));
    }

    public function find(){

        $q = Input::get('q');
        //$users=User::all()->where("username","like","%".$q."%");

        return response()->json([
            'status' => 'success',
            'users' => $users,
        ], 201);
    }

}
