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
        $body = $this->fileUpload($body);
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


    public function fileUpload($content)
    {
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('imageFile');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name = "/upload/" . time() . $item . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }

        return $dom->saveHTML();
    }
}
