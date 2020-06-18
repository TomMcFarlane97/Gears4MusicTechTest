<?php

namespace App\Factories;

use App\Interfaces\MailerInterface;
use App\Services\EmailSenderService;

class EmailFactory
{
    public static function email(): MailerInterface
    {
        return new EmailSenderService();
    }
}
