<?php

declare(strict_types=1);

namespace Codans\Domain\Values;

use Codans\Domain\Interfaces\Values\IGeoLocation;

class GeoLocation implements IGeoLocation
{
    /**
     * GeoLocation value object.
     *
     * @param string $country
     * @param string $countryCode
     * @param string $region
     * @param string $city
     * @param string $zipCode
     */
    public function __construct(
        private readonly string $country,
        private readonly string $countryCode,
        private readonly string $region,
        private readonly string $city,
        private readonly int $zipCode,
    ) {
    }
}
