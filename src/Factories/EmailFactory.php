<?php

namespace App\Factory;

use App\Interfaces\MailerInterface;

class EmailFactory
{
    public static function email(): MailerInterface
    {
        return new EmailSenderService();
    }
}
