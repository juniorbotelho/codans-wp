<?php

declare(strict_types=1);

namespace Codans\App\Constants;

enum Query: string
{
    /**
     * Subscriber id stored on email marketing platform.
     *
     * @var string
     */
    case SUBSCRIBER_ID = 'ck_subscriber_id';

	/**
	 * Subscriber email.
	 *
	 * @var string
	 */
	case EMAIL_ADDRESS = 'email';
}
