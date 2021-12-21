<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\CommentNotification;
use App\Notifications\TicketNotification;
use App\Notifications\TicketsNotifications;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public static function sendOfferNotification($ticket)
    {

        $users = User::role('Admin')->get();

        $offerData = [
            'name' => $ticket->title,
            'priority' => $ticket->priority,
            'ticket_id' => $ticket->ticket_id,



        ];

        Notification::send($users, new TicketNotification($offerData));
    }
    public function markNotification(Request $request)
    {
        // dd($request->all());
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }
    public static function sendCommentNotification($comment)
    {


        $users = User::role('User')->get();

        $offerData = [
       
            'name' => 'Comments',
            'comment' => $comment->comment,
            'ticket_id' => $comment->ticket_id,

        ];

        Notification::send($users, new CommentNotification($offerData));
    }
    public function TicketNotification(Request $request)
    {

        //  $notifications = auth()->user()->notifications;
        //  dd($notifications);

        // $notify = Notification::paginate(10);
        return view('Admin.home');
    }
    public function viewAll(Request $request)
    {

         $notifications = auth()->user()->notifications;
        //  dd($notifications);

        // $notify = Notification::paginate(10);
        return view('notification',compact('notifications'));
    }
}
