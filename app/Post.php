<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Subreddit;

class Post extends Model
{
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * PROBANDO
    * 
    * @var array
    */
   protected $fillable = [
       'name', 'body', 'creator_id', 'subreddit_id'
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
       
   ];

   /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
   protected $dates = ['deleted_at'];



    public function comments(){
        return $this->morphMany('App\Comment', "commentable");
    }

    public function getPostComments(){
        
        $postComments = $this->comments->groupBy("parent_id");
        dd($postComments[''][2]->replies);
        //$postComments["root"] = $postComments[''];
        //unset($postComments['']);

        $newComments = $postComments->map(function ($item, $key) use($postComments){
            foreach($item as $comment){
                $subComments[$comment->id] = $comment->replies->toArray();
              
                return $subComments;
            }
            
        });

        /*
        $all = collect();
        $all->push($postComments);
        $all->push($newComments);

        $all["root"] = $all[0];
        unset($all[0]);
        
        $all["root"] = $all['root'][''];
        unset($all['root']['']);
        $all[1] = $all[1][''];
        dd($all);*/
        //unset($all[1]['']);

        
        

    }
    

    public function user(){
        return $this->belongsTo(User::class,"creator_id");
    }

    public function subreddit(){
        return $this->belongsTo(Subreddit::class,"subreddit_id");
    }

    public function isOwner(User $user){
        return (bool) $this->user()->where("creator_id",$user->id);

    }

    public function votes(){
        return $this->morphMany('App\Vote', "voteable");
    }

    public function checkIfVoted(User $user){
        return $this->votes()->where("user_id",$user->id)->exists();
    }

    public function getVote(User $user){
        return $this->votes()->where("user_id",$user->id)->first();
    }

    public function getPoints(){
        $points = 0;
        foreach($this->votes as $vote){
            if($vote->type=="up"){
                $points=$points+1;
            }elseif($vote->type=="down") {
                $points=$points-1;
            }
        }

        return $points;
    }

    public function vote($type){
        //type = up,down or neutral?
        $user = auth()->user();
        //dd($this->checkIfvoted($user));
        //dd($this->id);
        if(!$this->checkIfVoted($user)){
            $vote = new Vote();
            $vote->user_id = $user->id;
            //$vote->voteable_id = $this->id;
            $vote->type = $type;
            $this->votes()->save($vote);
            return true;
        } else {
            $vote = $this->getVote($user);
            $vote->type = $type;
            $vote->save();
            return true;

        }      
    }

}
