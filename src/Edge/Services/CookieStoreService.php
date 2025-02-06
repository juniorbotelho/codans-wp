<?php

declare(strict_types=1);

namespace Codans\Edge\Services;

use Codans\App\Constants\Cookie;
use Codans\App\Protocols\ICookieHelper;
use Codans\App\Protocols\ICookieStoreService;

class CookieStoreService implements ICookieStoreService
{
    public function __construct(
        private readonly ICookieHelper $cookieHelper,
    ) {
    }

    /**
     * Store cookie.
     *
     * @since 1.0.0
     * @param string $cookie Cookie string format. E.g. `json_encode([])`.
     */
    public function execute(string $cookie): void
    {
        $name		= $this->cookieHelper->getName(Cookie::EMAIL_TRACKING_ACTION->value);
        $cookie		= $this->cookieHelper->encode($cookie);
        $expires_in	= $this->cookieHelper->getExpiresIn();
        $path		= $this->cookieHelper->getPath();
        $domain		= $this->cookieHelper->getDomain();

        setcookie($name, $cookie, (int) $expires_in, $path, $domain);
    }
}
