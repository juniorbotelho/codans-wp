<?php

declare(strict_types=1);

namespace Codans\App\Constants;

enum Cookie: string
{
    /**
     * Cookie name of Email Tracking Action.
     *
     * @var string
     */
    case EMAIL_TRACKING_ACTION = 'kit';

    /**
     * The root path represents all site.
     *
     * @var string
     */
    case PATH = '/';

    /**
     * Expires cookie in days. E.g: 180 days.
     *
     * @var string
     */
    case EXPIRES_IN = '180';
}
