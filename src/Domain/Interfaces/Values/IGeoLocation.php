<?php

declare(strict_types=1);

namespace Codans\Domain\Interfaces\Values;

use Codans\Domain\Protocols\IGeoLocationService;

interface IGeoLocation
{
	public function setGeoLocationService(IGeoLocationService $geoLocationService): void;
	public function getGeoLocation(): array;
}
