<?php

namespace App\Listeners;

use App\User;
use App\Events\GetRole;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Administrator
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  GetRole  $event
     * @return void
     */
    public function handle(GetRole $event)
    {
        //
    }
}
