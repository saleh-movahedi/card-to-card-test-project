<?php

namespace App\Services\Sms;

use Log;

class GhasedakSmsSService implements SmsServiceInterface
{

    public function send($phoneNumber, $message)
    {
        Log::info("send sms via " . __CLASS__ . "sms provider. number: ($phoneNumber)");
    }
}
