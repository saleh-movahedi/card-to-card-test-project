<?php

namespace App\Services;

use App\Services\Sms\GhasedakSmsSService;
use App\Services\Sms\KavehNegarSMSService;
use App\Services\Sms\SmsServiceInterface;
use Exception;

class SmsProviderFactory
{
    /**
     * @return SmsServiceInterface
     * @throws Exception
     */
    public static function create() : SmsServiceInterface
    {
        $selectedProvider = config('sms.provider');

        return match ($selectedProvider) {
            'kavehnegar' => new KavehNegarSMSService(),
            'ghasedak' => new GhasedakSmsSService(),
            default => throw new Exception('Invalid SMS provider specified in configuration.'),
        };
    }

}
