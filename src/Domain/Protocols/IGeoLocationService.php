<?php

declare(strict_types=1);

namespace Codans\Domain\Protocols;

interface IGeoLocationService
{
    public function execute(string $ipAddress): array;
}
