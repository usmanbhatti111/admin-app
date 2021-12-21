<?php

namespace App\Listeners;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewTicketNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $tickets = Ticket::whereHas('roles', function ($query) {
            $query->where('role','=', 'User');
        })->get();
        // return $tickets;
      
    Notification::send($tickets, new TicketNotification($event->ticket));
    }
}
