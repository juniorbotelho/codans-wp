<?php

declare(strict_types=1);

namespace Codans\Edge\Helpers;

use Codans\App\Protocols\ICookieHelper;
use Codans\App\Constants\Cookie;

class CookieHelper implements ICookieHelper
{
    /**
     * Encode cookie to prevent conflicts.
     *
     * @since 1.0.0
     * @param string $cookie
     * @return string
     */
    public function encode(string $cookie): string
    {
        return base64_encode($cookie);
    }

    /**
     * Get cookie name.
     *
     * @since 1.0.0
     * @param string $id
     * @return string
     */
    public function getName(string $id): string
    {
        return $id;
    }

    /**
     * Get cookie path.
     *
     * @since 1.0.0
     * @return string
     */
    public function getPath(): string
    {
        return Cookie::PATH->value;
    }

    /**
     * Get cookie expires unix timestamp.
     *
     * @since 1.0.0
     * @return int
     */
    public function getExpiresIn(): int
    {
        // Cast cookie expires in. E.g. (string) 180 days -> (int) 180 days
        $expires = (int) Cookie::EXPIRES_IN->value;

        if ($expires <= 0) {
            throw new \LogicException("Expires time must be a positive integer.");
        }

        return time() + 60 * 60 * 24 * $expires;
    }

    /**
     * Get cookie domain to set safe cookies.
     *
     * @since 1.0.0
     * @return string
     */
    public function getDomain(): string
    {
        $domain = preg_replace('/^(https?:\/\/)(www\.)?|(?!\w+):\d+$/i', '', home_url());

        // Check if domain was extracted correctly
        if (!$domain) {
            throw new \InvalidArgumentException("Invalid domain set: $domain");
        }

        return '.' . $domain;
    }
}
