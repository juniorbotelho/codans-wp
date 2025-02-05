<?php

declare(strict_types=1);

namespace Codans\App\Filters;

use Codans\App\Constants\Query;
use Codans\App\Interfaces\Filters\IRegisterQuery;

class RegisterQuery implements IRegisterQuery
{
    /**
     * Run register query action.
     *
     * @since 1.0.0
     * @param array $queries
     * @return array
     */
    public function run(array $queries): array
    {
        $queries[] = Query::SUBSCRIBER_ID->value;
		$queries[] = Query::EMAIL_ADDRESS->value;

        return $queries;
    }
}
