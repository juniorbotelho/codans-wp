<?php

declare(strict_types=1);

namespace Codans\App\Filters;

use Codans\Interfaces\Filters\IRegisterQuery;

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
        $queries[] = 'url';

        return $queries;
    }
}
