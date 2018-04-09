<?php

namespace App;
use App\Subreddit;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Un usuario puede tener varios subreddits pero un subreddit solo tiene un usuario.
    public function subreddits(){
        return $this->hasMany(Subreddit::class,'creator_id');
    }

    //Un usuario puede subscribirse a varios subreddits
    public function subscriptions(){
        return $this->hasMany(Subscription::class,'user_id');
    }
    //Para saber si esta suscrito a un subreddit o no
    public function isSubscribedTo(Subreddit $subreddit){
        return (bool) $this->subscriptions->where('subreddit_id', $subreddit->id)->count();
    }

    //Un usuario puede hacer varios posts en un subreddit pero un post solo tiene un usuario
    public function posts(){
        return $this->hasMany(Post::class, 'creator_id');
    }

    //Un usuario puede hacer varios comentarios en un post de un subreddit pero un comentario solo tiene un usuario
    public function comments(){
        return $this->hasMany(Comment::class, 'creator_id');
    }

    //Listing all the roles this user has
    public function roles(){
        return $this->belongsToMany(Role::class,"user_id");
    }

    //Know the roles the user has in this subreddit
    public function userRolesInThisSubreddit(Subreddit $subreddit){
        return (bool) $this->roles->where('subreddit_id', $subreddit->id);
    }

    
    //Un usuario puede tener varios votos pero un usuario solo puede emitir uno en un comentario.
        /*
    //Para devolver los subreddits que se ha suscrito
    public function subscribedSubreddits(){
        return $this->belongsToMany(Subreddit::class,"subscriptions");
     }

    //Para saber si esta suscrito a un subreddit o no
    public function ownsSubreddit(Subreddit $subreddit){
        return (bool) $this->subreddits->where('id', $subreddit->id)->count();
    }
    */
}
