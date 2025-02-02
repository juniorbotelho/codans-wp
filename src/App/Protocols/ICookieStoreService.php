<?php

declare(strict_types=1);

namespace Codans\App\Protocols;

interface ICookieStoreService
{
    public function execute(string $cookie): void;
}
