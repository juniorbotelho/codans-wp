<?php

declare(strict_types=1);

namespace Codans\Presenter\Hook;

use Codans\Domain\Values\{Email, GeoLocation, PhoneNumber, Tag};
use Codans\Domain\Entities\Subscriber;
use Codans\App\Actions\CaptureSubscriberAction;
use Codans\App\Constants\Cookie;
use Codans\Edge\Adapters\LibPhoneNumberAdapter;
use Codans\Edge\Helpers\CookieHelper;
use Codans\Edge\Services\CookieStoreService;

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
		$cookie = $_COOKIE[Cookie::EMAIL_TRACKING_ACTION->value];
		$cookie = base64_decode($cookie);
		$cookie = json_decode($cookie);

		// Edge
        $libPhoneNumberAdapter = new LibPhoneNumberAdapter();

		// Domain
        $email			= new Email($cookie['email']);
        $geoLocation 	= new GeoLocation('127.0.0.1');
        $phoneNumber 	= new PhoneNumber($cookie['phoneNumber']);
		$tags			= [];

		// Tags
		foreach ($cookie['tags'] as $tag) {
			$tags[] = new Tag($tag->name, $tag->id);
		}

        $subscriber 	= new Subscriber($cookie['id'], $cookie['firstName'], $cookie['lastName'], $email, $geoLocation, $phoneNumber, $tags);

		$subscriber->setContainer([
            '@geoLocationService'	 => [],
            '@libPhoneNumberAdapter' => $libPhoneNumberAdapter,
        ]);

		// Implementation
        $cookieHelper 		= new CookieHelper();
        $cookieStoreService = new CookieStoreService($cookieHelper);
        $action 			= new CaptureSubscriberAction($cookieStoreService);
        $action->run();
    }
}
