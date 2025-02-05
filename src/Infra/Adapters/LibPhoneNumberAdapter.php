<?php

declare(strict_types=1);

namespace Codans\Infra\Adapters;

use Codans\Domain\Protocols\ILibPhoneNumberAdapter;

class LibPhoneNumberAdapter implements ILibPhoneNumberAdapter
{
	/**
	 * Get country.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function getCountry(): string
	{
		return $this->libPhoneNumber->getCountry();
	}

	/**
	 * Get country code.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function getCountryCode(): string
	{
		return $this->libPhoneNumber->getCountryCode();
	}

	/**
	 * Get country code phone. E.g: +55 (Brazil).
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function getCountryCodePhone(): string
	{
		return $this->libPhoneNumber->getCountryCodePhone();
	}

	/**
	 * Check if phone number is valid.
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	public function isValid(): bool
	{
		return $this->libPhoneNumber->isValid();
	}

	/**
	 * Check if phone number is possible.
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	public function isPossible(): bool
	{
		return $this->libPhoneNumber->isPossible();
	}

	/**
	 * Get phone type. E.g: Mobile.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function getType(): string
	{
		return $this->libPhoneNumber->getType();
	}

	/**
	 * Get international format.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function getInternationalFormat(): string
	{
		return $this->libPhoneNumber->getInternationalFormat();
	}

	/**
	 * Get national format.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function getNationalFormat(): string
	{
		return $this->libPhoneNumber->getNationalFormat();
	}

	/**
	 * Get E.164 phone format.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function getE164Format(): string
	{
		return $this->libPhoneNumber->getE164Format();
	}

	/**
	 * Get RFC3966 phone format.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function getRFC3966Format(): string
	{
		return $this->libPhoneNumber->getRFC3966Format();
	}
}
