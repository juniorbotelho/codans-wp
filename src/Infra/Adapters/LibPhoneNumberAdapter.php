<?php

declare(strict_types=1);

namespace Codans\Infra\Adapters;

use Codans\Domain\Protocols\ILibPhoneNumberAdapter;
use libphonenumber\{NumberParseException, PhoneNumber, PhoneNumberFormat, PhoneNumberUtil};

class LibPhoneNumberAdapter implements ILibPhoneNumberAdapter
{
	private readonly PhoneNumberUtil $libPhoneNumber;
	private readonly PhoneNumber $phoneNumber;

	/**
	 * Set Phone number.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function setPhoneNumber(string $phoneNumber): void
	{
		try {
			$this->libPhoneNumber = PhoneNumberUtil::getInstance();
			$this->phoneNumber = $this->libPhoneNumber->parse($phoneNumber);
		} catch (NumberParseException $e) {
			// TODO: Put NumberParseException to custom exception.
			throw $e;
		}
	}

	/**
	 * Get country.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function getCountry(): string
	{
		return $this->libPhoneNumber->getRegionCodeForNumber($this->phoneNumber);
	}

	/**
	 * Get country code.
	 *
	 * @since 1.0.0
	 * @return int
	 */
	public function getCountryCode(): int
	{
		$country = $this->getCountry();

		return $this->libPhoneNumber->getCountryCodeForRegion($country);
	}

	/**
	 * Check if phone number is valid.
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	public function isValid(): bool
	{
		return $this->libPhoneNumber->isValidNumber($this->phoneNumber);
	}

	/**
	 * Check if phone number is possible.
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	public function isPossible(): bool
	{
		return $this->libPhoneNumber->isPossibleNumber($this->phoneNumber);
	}

	/**
	 * Get phone type. E.g: Mobile.
	 *
	 * @since 1.0.0
	 * @return int
	 */
	public function getType(): int
	{
		return $this->libPhoneNumber->getNumberType($this->phoneNumber);
	}

	/**
	 * Get international format.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function getInternationalFormat(): string
	{
		return $this->libPhoneNumber->format($this->phoneNumber, PhoneNumberFormat::INTERNATIONAL);
	}

	/**
	 * Get national format.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function getNationalFormat(): string
	{
		return $this->libPhoneNumber->format($this->phoneNumber, PhoneNumberFormat::NATIONAL);
	}

	/**
	 * Get E.164 phone format.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function getE164Format(): string
	{
		return $this->libPhoneNumber->format($this->phoneNumber, PhoneNumberFormat::E164);
	}
}
