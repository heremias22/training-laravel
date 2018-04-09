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
        $subscriptionExists = auth()->user()->subscriptions()->where("subreddit_id",$id)->first();

        if(!$subscriptionExists){
            $subscription = Subscription::create([
                'user_id' => auth()->user()->id, 
                'subreddit_id' => $id
            ]);  
        }
        return response()->json([], 200);
    
    }

    public function Unsubscribe(){

        $id = Input::get('id');
        
        $subscribedToSubredit = auth()->user()->subscriptions()->where("subreddit_id",$id)->first();
        if($subscribedToSubredit){
            $subscribedToSubredit->delete();
        }

        return response()->json([], 201);
      

    }


}
