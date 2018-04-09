<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    //users that have this role
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
