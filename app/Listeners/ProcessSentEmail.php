<?php

namespace App\Listeners;

use App\Events\EmailSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ProcessSentEmail
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
     * @param  \App\Events\EmailSent  $event
     * @return void
     */
    public function handle(EmailSent $event)
    {
        $request = $event->input;
        $users = User::find($request->to);
        $subject = $request->subject;
        $body = $request->body;
        foreach ($users as  $user) {
            $vars = array(
                "{{name}}" => $user->name,
                "{{email}}" => $user->email,
            );

            $body = strtr($body, $vars);
            Mail::send('mail.email', ['body' => $body], function ($m) use ($user, $subject) {
                $m->to($user->email)->subject($subject);
            });
        }
    }
}
