<?php

namespace App\Services;

use App\Interfaces\MailerInterface;

class EmailSenderService implements MailerInterface
{
    public function send(): bool
    {
        return true;
        // TODO: Implement send() method.
    }

    public function setRecipient(): void
    {
        // TODO: Implement setRecipient() method.
    }

    public function setBody(array $data): void
    {
        // TODO: Implement setBody() method.
    }

    public function setHeader(string $header): void
    {
        // TODO: Implement setHeader() method.
    }
}
