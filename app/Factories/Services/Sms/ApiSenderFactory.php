<?php


namespace App\Factories\Services\Sms;


use App\Services\Sms\ApiSender;
use App\Services\Sms\SmsSender;
use App\Factories\Services\Sms\Interfaces\SmsSenderFactory;

class ApiSenderFactory implements SmsSenderFactory
{

    public function create(): SmsSender
    {
        return new ApiSender('https://www.send-sms.com', 'random-secret-key');
    }
}
