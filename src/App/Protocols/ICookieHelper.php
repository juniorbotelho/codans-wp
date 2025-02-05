<?php

declare(strict_types=1);

namespace Codans\App\Protocols;

interface ICookieHelper
{
    public function encode(string $cookie): string;
    public function getName(string $id): string;
    public function getPath(): string;
    public function getExpiresIn(): int;
    public function getDomain(): string;
}
