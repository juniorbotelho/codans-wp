<?php

declare(strict_types=1);

namespace Codans\Controller;

use Codans\App\Filters\RegisterQuery;

class RegisterQueryController
{
    /**
     * Register the filter hook.
     *
     * @since 1.0.0
     * @return void
     */
    public static function register(): void
    {
        add_filter('query_vars', [self::class, 'action']);
    }

    /**
     * Act as a mediator, redirecting to url and saving user track to cookie.
     *
     * @since 1.0.0
     * @param array $queries
     * @return array
     */
    public static function action(array $queries): array
    {
        $action = new RegisterQuery();
        return $action->run($queries);
    }
}
