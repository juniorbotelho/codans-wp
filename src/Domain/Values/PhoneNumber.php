<?php

declare(strict_types=1);

namespace Codans\Domain\Values;

use Codans\Domain\Interfaces\Values\IPhoneNumber;

class PhoneNumber implements IPhoneNumber
{
    /**
     * Phone number value object.
     *
     * @param string $country,
     * @param string $countryCode,
     * @param string $countryCodePhone,
     * @param bool $isValid,
     * @param bool $isPossible,
     * @param string $type,
     * @param string $internationalFormat,
     * @param string $nationalFormat,
     * @param string $e164Format,
     * @param string $rfc3966Format,
     */
    public function __construct(
        private readonly string $country,
        private readonly string $countryCode,
        private readonly string $countryCodePhone,
        private readonly bool $isValid,
        private readonly bool $isPossible,
        private readonly string $type,
        private readonly string $internationalFormat,
        private readonly string $nationalFormat,
        private readonly string $e164Format,
        private readonly string $rfc3966Format,
    ) {
    }
}
