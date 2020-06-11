<?php


namespace App\Factories\Services\Sms;


use App\Services\Sms\ArraySender;
use App\Services\Sms\SmsSender;
use App\Factories\Services\Sms\Interfaces\SmsSenderFactory;

class ArraySenderFactory implements SmsSenderFactory
{
    public function create(): SmsSender
    {
        return new ArraySender();
    }
}
