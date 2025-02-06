<?php

declare(strict_types=1);

namespace Codans\Presenter\Hook;

use Codans\Domain\Values\Email;
use Codans\Domain\Values\GeoLocation;
use Codans\Domain\Values\PhoneNumber;
use Codans\Domain\Values\Tag;
use Codans\Domain\Entities\Subscriber;
use Codans\App\Actions\CaptureSubscriberAction;
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
		$libPhoneNumberAdapter = new LibPhoneNumberAdapter();

		$email			= new Email('junowerther@gmail.com');
		$geoLocation 	= new GeoLocation('Brazil', 'BR', 'PA', 'Castanhal', 68740);
		$phoneNumber 	= new PhoneNumber('+55 (91) 99116-4199');
		$tag			= new Tag('Ação: Visualizou a grade de conteúdo', 1164199);

		$id			= 1;
		$firstName 	= 'Junior';
		$lastName 	= 'Botelho';
		$subscriber = new Subscriber($id, $firstName, $lastName, $email, $geoLocation, $phoneNumber, [$tag]);

		$subscriber->setContainer([
			'@geoLocationService'	 => [],
			'@libPhoneNumberAdapter' => $libPhoneNumberAdapter,
		]);

        $cookieHelper 		= new CookieHelper();
        $cookieStoreService = new CookieStoreService($cookieHelper);
        $action 			= new CaptureSubscriberAction($cookieStoreService);
        $action->run();
    }
}
