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
        return $this->hasMany(Comment::class);
    }

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
}
