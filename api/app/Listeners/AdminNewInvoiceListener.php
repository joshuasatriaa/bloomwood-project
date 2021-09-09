<?php

namespace App\Listeners;

use App\Events\NewInvoiceEvent;
use App\Models\Role;
use App\Models\User;
use App\Notifications\AdminNewInvoiceNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AdminNewInvoiceListener
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
     * @param  App\Events\NewInvoiceEvent  $event
     * @return void
     */
    public function handle(NewInvoiceEvent $event)
    {
        $roles = Role::whereIn('slug', ['superadmin', 'admin'])->get()->pluck('_id')->toArray();

        // Notify Admins
        User::whereIn('role_id', $roles)->get()->map(function ($user) {
            $user->notify(new AdminNewInvoiceNotification);
        });
    }
}
