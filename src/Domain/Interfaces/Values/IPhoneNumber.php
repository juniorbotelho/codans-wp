<?php

declare(strict_types=1);

namespace Codans\Domain\Interfaces\Values;

use Codans\Domain\Protocols\ILibPhoneNumberAdapter;

interface IPhoneNumber
{
    public function setPhoneNumberAdapter(ILibPhoneNumberAdapter $libPhoneNumber): void;
    public function getPhoneNumber(): array;
}
