<?php

declare(strict_types=1);

namespace Codans\App\Actions;

use Codans\App\Constants\{Query, Url};
use Codans\App\Interfaces\Actions\ICaptureSubscriberAction;
use Codans\App\Protocols\ICookieStoreService;

class CaptureSubscriberAction implements ICaptureSubscriberAction
{
    public function __construct(
        private readonly ICookieStoreService $cookieService,
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

        $subscriberId = get_query_var(Query::SUBSCRIBER_ID->value);

        // Stop any handling if the subscriber id aren't valid integer
        if (!filter_var($subscriberId, FILTER_VALIDATE_INT)) {
            return;
        }

        $id = (int) $subscriberId;

        $cookie = json_encode([
            'data' => [
                'id' 	=> $id,
            ],
        ]);

        $this->cookieService->execute($cookie);
    }
}
