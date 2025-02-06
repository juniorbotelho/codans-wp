<?php

declare(strict_types=1);

namespace Codans\Domain\Interfaces\Entities;

interface ISubscriber
{
    public function setContainer(array $container): void;
    public function getModel(): array;
}
