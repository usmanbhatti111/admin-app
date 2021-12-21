<?php

namespace App\View\Components\Main;

use Illuminate\View\Component;

class NotificationComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $notifications = auth()->user()->notifications;
        $count= $notifications->count();


        return view('components.main.notification-component',compact('notifications','count'));
    }
}
