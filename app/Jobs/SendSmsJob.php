<?php

namespace App\Jobs;

use App\Services\SmsProviderFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $phoneNumber;
    protected $message;
    protected $smsService;

    /**
     * Create a new job instance.
     */
    public function __construct($phoneNumber, $message)
    {
        //
        $this->phoneNumber = $phoneNumber;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            $this->smsService = SmsProviderFactory::create();
            // Send the SMS using the injected SMSService
            $this->smsService->send($this->phoneNumber, $this->message);
        } catch (\Exception $e) {
            $this->fail($e);
        }
    }
}
