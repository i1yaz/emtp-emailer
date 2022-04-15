<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Support\Facades\Mail;
use App\Models\ActiveSmtp;
use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

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
        $activeSmtp = ActiveSmtp::first();
        $smtpSetting = SmtpSetting::find($activeSmtp->smtp_setting_id);
        if (isset($smtpSetting->id)) {

            $config = array(

                'driver'     => 'smtp',

                'host'       => $smtpSetting->host ?? localhost,

                'port'       => $smtpSetting->port ?? 2525,

                'from'       => array('address' => $smtpSetting->from_address, 'name' => $smtpSetting->from_name),

                'encryption' => $smtpSetting->encryption ?? NULL,

                'username'   => $smtpSetting->username ?? NULL,

                'password'   => $smtpSetting->password ?? NULL

            );

            Config::set('mail', $config);
        }

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
