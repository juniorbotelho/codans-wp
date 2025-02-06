<?php

declare(strict_types=1);

namespace Codans\Domain\Values;

use Codans\Domain\Interfaces\Values\IGeoLocation;
use Codans\Domain\Protocols\IGeoLocationService;

class GeoLocation implements IGeoLocation
{
    private readonly string $country;
    private readonly int $countryCode;
    private readonly string $region;
    private readonly string $regionName;
    private readonly string $city;
    private readonly int $zipCode;

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
        private readonly string $ipAddress,
    ) {
    }

    /**
     * Set Geo location service.
     *
     * @since 1.0.0
     * @param IGeoLocationService $geoLocationService
     * @return void
     */
    public function setGeoLocationService(IGeoLocationService $geoLocationService): void
    {
        $geoLocation = $geoLocationService->execute($this->ipAddress);

        $this->country 		= $geoLocation['country'];
        $this->countryCode 	= $geoLocation['countryCode'];
        $this->region 		= $geoLocation['region'];
        $this->regionName 	= $geoLocation['regionName'];
        $this->city			= $geoLocation['city'];
        $this->zipCode		= (int) $geoLocation['zip'];
    }

    /**
     * Get GeoLocation.
     *
     * @since 1.0.0
     * @return array { country: string, countryCode: int, region: string, regionName: string, city: string, zipCode: int }
     */
    public function getGeoLocation(): array
    {
        $geoLocation = [
            'country' 		=> $this->country,
            'countryCode' 	=> $this->countryCode,
            'region'		=> $this->region,
            'regionName'	=> $this->regionName,
            'city'			=> $this->city,
            'zipCode'		=> $this->zipCode,
        ];

        return $geoLocation;
    }
}
