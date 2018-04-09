<?php

namespace App\Listeners;

use App\Events\GetRole;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Moderator
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
