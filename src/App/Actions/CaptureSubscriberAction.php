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

        if (!$cookie) {
			throw new \JsonException("The json encode has failed." . json_last_error_msg());
		}

		$this->cookieService->execute($cookie);
    }
}
