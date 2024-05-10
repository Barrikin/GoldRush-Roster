<?php

namespace App\Listeners;

use App\Events\SopCreated;
use App\Models\SopSignOff;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LinkNewSoptoOfficers
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SopCreated $event): void
    {
        $users = User::pluck('id');

        foreach ($users as $user) {
           SopSignOff::create([
                'sop_id' => $event->id,
                'user_id' => $user->id,
           ]);
        }
    }
}
