<?php

declare(strict_types=1);

namespace Codans\App\Protocols;

interface ILogEmail
{
    public function send(string $error_message): void;
    public function setRecipient(string $email_receptor): void;
}
