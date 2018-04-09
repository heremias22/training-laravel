<?php

namespace App\Http\Controllers;

use auth;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SubscriptionsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function subscribe(){

        $id = Input::get('id');

        $subscriptionExists = Subscription::where("subreddit_id",$id)->where("user_id",auth()->user()->id)->get();

        if($subscriptionExists){
            //dd($subscriptionExists);
            $subscriptionExists->delete();
            return response()->json(['unsubscribed']);

        } else {

            $subscription = Subscription::create([
                'user_id' => auth()->user()->id, 
                'subreddit_id' => $id
            ]);  
            
            return response()->json(['subscribed']);
        }

      
    }


}
