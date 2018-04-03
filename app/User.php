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
    public function subreddits()
    {
        return $this->hasMany(Subreddit::class,'creator_id');
    }
}
