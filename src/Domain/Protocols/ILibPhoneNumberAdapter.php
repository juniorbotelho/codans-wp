<?php

declare(strict_types=1);

namespace Codans\Domain\Protocols;

interface ILibPhoneNumberAdapter
{
	public function setPhoneNumber(string $phoneNumber): void;
	public function getCountry(): string;
	public function getCountryCode(): int;
	public function isValid(): bool;
	public function isPossible(): bool;
	public function getType(): int;
	public function getInternationalFormat(): string;
	public function getNationalFormat(): string;
	public function getE164Format(): string;
}
