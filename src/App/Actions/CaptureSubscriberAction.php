<?php

declare(strict_types=1);

namespace Codans\App\Actions;

use Codans\Constants\{Cookie, Query, Url};
use Codans\Interfaces\Actions\ICaptureSubscriberAction;
use Codans\Interfaces\Helpers\ICookieHelper;

class CaptureSubscriberAction implements ICaptureSubscriberAction
{
    public function __construct(
        private readonly ICookieHelper $cookieHelper,
    ) {
    }

    /**
     * Run redirect action.
     *
     * @since 1.0.0
     * @return void
     */
    public function run(): void
    {
        if (!is_page(Url::REDIRECT_PAGE_URL->value)) {
            return;
        }

        $query = get_query_var(Query::SUBSCRIBER_ID->value);

        // Stop any handling if the subscriber id aren't valid integer
        if (!filter_var($query, FILTER_VALIDATE_INT)) {
            return;
        }

        $id = (int) $query;

        $cookie = json_encode([
            'origin' => hash('sha256', $query),
            'data' 	 => [
                'id' 	=> $id,
                'email' => null,
            ],
        ]);

        $name		= $this->cookieHelper->getName(Cookie::EMAIL_TRACKING_ACTION->value);
        $cookie		= $this->cookieHelper->encode($cookie);
        $expires_in	= $this->cookieHelper->getExpiresIn();
        $path		= $this->cookieHelper->getPath();
        $domain		= $this->cookieHelper->getDomain();

        setcookie($name, $cookie, (int) $expires_in, $path, $domain);
    }
}
