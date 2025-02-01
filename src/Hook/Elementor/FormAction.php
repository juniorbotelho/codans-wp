<?php

declare(strict_types=1);

namespace Codans\Elementor\Hook;

use ElementorPro\Modules\Forms\Registrars\Form_Actions_Registrar;
use Codans\Elementor\Actions\KitAction;
use Codans\Utils\LogEmail;

class FormAction
{
	/**
	 * Register the action hook.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public static function start(): void
	{
		add_action('elementor_pro/forms/actions/register', [self::class, 'action']);
	}

	/**
	 * Add new subscriber to Kit.
	 *
	 * @since 1.0.0
	 * @param Form_Actions_Registrar $form_actions_registrar
	 * @return void
	 */
	public static function action(Form_Actions_Registrar $form_actions_registrar)
	{
		$email_provider = $_ENV['EMAIL_PROVIDER'] ?? '';
		$email_receptor = $_ENV['EMAIL_RECEPTOR'] ?? '';

		$log_email = new LogEmail($email_provider, $email_receptor);
		$custom_kit_action = new KitAction($log_email);

		$form_actions_registrar->register($custom_kit_action);
	}
}
