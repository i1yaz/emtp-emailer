<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;
    public $tries = 10;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        $body = $data['body'];
        $contact = $data['contact'];
        $subject = $data['subject'];
        $attachments = $data['attachments'];
        Mail::send('mail.email', ['body' => $body], function ($m) use ($contact, $subject, $attachments) {
            $m->to($contact->email)->subject($subject);
            foreach ($attachments as $attachment) {
                $m->attach($attachment);
            }
        });
    }
    public function middleware()
    {
        return [new RateLimited('email')];
    }
}
