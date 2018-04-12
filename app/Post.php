<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    /*
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    */

    public function user(){
        return $this->belongsTo(User::class,"creator_id");
    }

    public function subreddit(){
        return $this->belongsTo(Subreddit::class,"subreddit_id");
    }

    public function isOwner(User $user){
        if($this->user->id === $user->id){
            return True;
        } else {
            return false;
        }
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
