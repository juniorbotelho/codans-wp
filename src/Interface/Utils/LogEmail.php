<?php

declare(strict_types=1);

namespace Codans\Interfaces\Utils;

interface ILogEmail
{
    public function send_email_log(string $error_message): void;
    public function set_email_recipient(string $email_receptor): void;
}
