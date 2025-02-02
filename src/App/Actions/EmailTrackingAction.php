<?php

declare(strict_types=1);

namespace Codans\App\Actions;

use Codans\Constants\Query;
use Codans\Interfaces\Actions\IEmailTrackingAction;

class EmailTrackingAction implements IEmailTrackingAction
{
    /**
     * Run redirect action.
     *
     * @since 1.0.0
     * @return void
     */
    public function run(): void
    {
        if (!is_page('redirecionamento')) {
            return;
        }

        $query = get_query_var(Query::SUBSCRIBER_ID->value);

        // Stop any handling if the subscriber id aren't valid integer
        if (!filter_var($query, FILTER_VALIDATE_INT)) {
            return;
        }

        $id = (int) $query;

        echo $id;
    }
}
