<?php

declare(strict_types=1);

namespace Codans\Domain\Protocols;

interface ILibPhoneNumberAdapter
{
	public function setPhoneNumber(string $phoneNumber): void;
	public function getCountry(): string;
	public function getCountryCode(): string;
	public function getCountryCodePhone(): string;
	public function isValid(): bool;
	public function isPossible(): bool;
	public function getType(): string;
	public function getInternationalFormat(): string;
	public function getNationalFormat(): string;
	public function getE164Format(): string;
	public function getRFC3966Format(): string;
}
