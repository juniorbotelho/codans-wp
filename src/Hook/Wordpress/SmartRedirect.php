<?php

declare(strict_types=1);

namespace Codans\Wordpress\Hook;

use Codans\Wordpress\Actions\RedirectAction;

class SmartRedirect
{
	/**
	 * Register the action hook.
	 *
	 * @since 1.0.0
	 * @return void
	 */
    public static function start(): void
    {
        add_action('wp_footer', [self::class, 'action']);
    }

    /**
     * Act as a mediator, redirecting to url and saving user track to cookie.
     *
     * @since 1.0.0
     * @return void
     */
    public static function action(): void
    {
        $action = new RedirectAction();
        $action->run();
    }
}
