<?php

declare(strict_types=1);

namespace Codans\Domain\Values;

use Codans\Domain\Interfaces\Values\IEmail;

class Email implements IEmail
{
	/**
	 * Email value object.
	 *
	 * @param string $address
	 * @param string $domain
	 */
	public function __construct(
		private readonly string $addres,
		private readonly ?string $domain = null,
	) {
	}
}
