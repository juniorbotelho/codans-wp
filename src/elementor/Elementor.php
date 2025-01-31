<?php

namespace Codans\Codans\Elementor;

if (! defined('ABSPATH')) {
	exit;
}

use \Codans\Codans\Elementor\Actions\CustomKitAction;
use \Codans\Codans\Utils\LogEmail;

/**
 * Add new subscriber to Kit.
 *
 * @since 1.0.0
 * @param ElementorPro\Modules\Forms\Registrars\Form_Actions_Registrar $form_actions_registrar
 * @return void
 */
function custom_elementor_form_actions($form_actions_registrar)
{
	$email_provider = $_ENV['EMAIL_PROVIDER'] || '';
	$email_receptor = $_ENV['EMAIL_RECEPTOR'] || '';

	$log_email 			= new LogEmail($email_provider, $email_receptor);
	$custom_kit_action 	= new CustomKitAction($log_email);

	$form_actions_registrar->register($custom_kit_action);
}

add_action('elementor_pro/forms/actions/register', 'custom_elementor_form_actions');
