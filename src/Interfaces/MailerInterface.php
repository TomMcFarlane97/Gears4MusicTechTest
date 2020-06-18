<?php

namespace App\Interfaces;

interface MailerInterface
{
    public function send(): bool;
    public function setRecipient(): void;
    public function setBody(array $data): void;
    public function setHeader(string $header): void;
}
