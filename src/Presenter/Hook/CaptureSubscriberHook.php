<?php

declare(strict_types=1);

namespace Codans\Presenter\Hook;

use Codans\App\Actions\CaptureSubscriberAction;
use Codans\Infra\Helpers\CookieHelper;
use Codans\Infra\Services\CookieStoreService;

class CaptureSubscriberHook
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
        $cookieHelper 		= new CookieHelper();
        $cookieStoreService = new CookieStoreService($cookieHelper);
        $action 			= new CaptureSubscriberAction($cookieStoreService);
        $action->run();
    }
}
