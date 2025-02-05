<?php

declare(strict_types=1);

namespace Codans\Domain\Entities;

use Codans\Domain\Interfaces\Entities\ISubscriber;
use Codans\Domain\Interfaces\Values\{IEmail, IGeoLocation, IPhoneNumber, ITag};

class Subscriber implements ISubscriber
{
	/**
	 * Create subscriber entity.
	 *
	 * @param int $id
	 * @param string $firstName
	 * @param string $lastName
	 * @param IEmail $email
	 * @param IGeoLocation $geoLocation
	 * @param IPhoneNumber $phoneNumber
	 * @param ITag[] $tags
	 */
	public function __construct(
		private readonly int $id,
		private readonly string $firstName,
		private readonly string $lastName,
		private readonly IEmail $email,
		private readonly IGeoLocation $geoLocation,
		private readonly IPhoneNumber $phoneNumber,
		private readonly array $tags,
		private readonly ?string $created_at = null,
		private readonly ?string $updated_at = null,
	) {
	}
}
