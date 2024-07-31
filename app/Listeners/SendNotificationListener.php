<?php
//
//namespace App\Listeners;
//
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Queue\InteractsWithQueue;
//
//class SendNotificationListener
//{
//    /**
//     * Create the event listener.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        //
//    }
//
//    /**
//     * Handle the event.
//     *
//     * @param  object  $event
//     * @return void
//     */
//    public function handle($event)
//    {
//        $userEmail = 'mohamedgaber255255@gmail.com';
//
//        Mail::raw($event->message, function ($message) use ($userEmail) {
//            $message->to($userEmail)
//                ->subject('New Notification');
//        });
//    }
//}
