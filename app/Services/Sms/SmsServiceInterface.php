<?php

namespace App\Services\Sms;

interface SmsServiceInterface
{
    public function send($phoneNumber, $message);

}
