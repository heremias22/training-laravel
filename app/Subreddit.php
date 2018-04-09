<?php

namespace App;

use App\SubredditModerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subreddit extends Model
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
        'name', 'description', 'creator_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function moderators(){
        return $this->hasMany(User::class,"");
    }

}
