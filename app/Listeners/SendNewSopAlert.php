<?php

namespace App\Listeners;

use App\Events\SopCreated;
use App\Models\User;
use App\Models\UserAlert;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewSopAlert
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

        $userAlert = UserAlert::create([
            'alert_text' => 'New SOP ('.$event->title.') to sign off on.',
            'alert_link' => route('admin.sops.show', $event->id),
            ]);

        $userAlert->users()->sync($users);
    }
}
