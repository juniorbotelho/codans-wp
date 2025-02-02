<?php

declare(strict_types=1);

namespace Codans\Controller;

use Codans\App\Actions\EmailTrackingAction;
use Codans\App\Helpers\CookieHelper;

class EmailTrackingController
{
    /**
     * Register the action hook.
     *
     * @since 1.0.0
     * @return void
     */
    public static function register(): void
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
        $cookieHelper = new CookieHelper();
        $action = new EmailTrackingAction($cookieHelper);
        $action->run();
    }
}
