<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\CustomTransportManager;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use App\Models\ActiveSmtp;
use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Schema;

class EmailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('active_smtp')) {
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
        }
    }
}
