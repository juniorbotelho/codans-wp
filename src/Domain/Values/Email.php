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
        public readonly string $address,
        public readonly ?string $domain = null,
    ) {
    }

	/**
	 * Get email.
	 *
	 * @since 1.0.0
	 * @return array { address: string, domain: string }
	 */
	public function getEmail(): array
	{
		$email = [
			'address' => $this->address,
			'domain'  => $this->domain,
		];

		return $email;
	}
}
