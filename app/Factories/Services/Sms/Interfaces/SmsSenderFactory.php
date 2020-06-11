<?php


namespace App\Factories\Services\Sms\Interfaces;


use App\Services\Sms\SmsSender;

interface SmsSenderFactory
{
    public function create(): SmsSender;
}
