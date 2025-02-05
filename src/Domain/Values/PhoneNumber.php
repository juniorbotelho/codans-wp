<?php

declare(strict_types=1);

namespace Codans\Domain\Values;

use Codans\Domain\Interfaces\Values\IPhoneNumber;
use Codans\Domain\Protocols\ILibPhoneNumberAdapter;

class PhoneNumber implements IPhoneNumber
{
	/**
	 * @var ILibPhoneNumberAdapter $libPhoneNumber
	 */
	private readonly ILibPhoneNumberAdapter $libPhoneNumber;

    /**
     * Phone number value object.
     *
     * @param string $phoneNumber
     */
    public function __construct(
        private readonly string $phoneNumber,
    ) {
    }

	/**
	 * Set the `lib-phonenumber` adapter.
	 *
	 * @var ILibPhoneNumberAdapter $libPhoneNumber
	 */
	public function setFormatter(ILibPhoneNumberAdapter $libPhoneNumber): void
	{
		$libPhoneNumber->setPhoneNumber($this->phoneNumber);

		$this->libPhoneNumber = $libPhoneNumber;
	}

	/**
	 * Build phone number format.
	 *
	 * @since 1.0.0
	 * @return array{ country: string, countryCode: string, countryCodePhone: string, isValid: bool, isPossible: bool, type: string, internationalFormat: string, nationalFormat: string, e164Format: string, rfc3966Format: string } $phoneNumber
	 */
	public function getValue(): array
	{
		$phoneNumber = [
			'country'				=> $this->libPhoneNumber->getCountry(),
			'countryCode'			=> $this->libPhoneNumber->getCountryCode(),
			'countryCodePhone'		=> $this->libPhoneNumber->getCountryCodePhone(),
			'isValid'				=> $this->libPhoneNumber->isValid(),
			'isPossible'			=> $this->libPhoneNumber->isPossible(),
			'type'					=> $this->libPhoneNumber->getType(),
			'internationalFormat'	=> $this->libPhoneNumber->getInternationalFormat(),
			'nationalFormat'		=> $this->libPhoneNumber->getNationalFormat(),
			'e164Format'			=> $this->libPhoneNumber->getE164Format(),
			'rfc3966Format'			=> $this->libPhoneNumber->getRFC3966Format(),
		];

		return $phoneNumber;
	}
}
