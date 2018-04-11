<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
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
       'body', 'post_id', 'creator_id'
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
   /*
   public function commentable(){
       return $this->morphTo();
   }
   */

   
   public function post(){
       return $this->belongsTo(Post::class,"post_id");
   }

   public function user(){
       return $this->belongsTo(User::class,"creator_id");
   }

   public function isOwner(User $user){
       return ($this->user->id==$user->id);
   }
}
