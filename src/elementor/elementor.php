<?php

namespace Codans\Codans\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Codans\Codans\Elementor\Actions\Custom_Kit_Action;
use \Codans\Codans\Utils\Log_Email;

/**
 * Add new subscriber to Kit.
 *
 * @since 1.0.0
 * @param ElementorPro\Modules\Forms\Registrars\Form_Actions_Registrar $form_actions_registrar
 * @return void
 */
function custom_elementor_form_actions( $form_actions_registrar ) {

	$log_email = new Log_Email( '', '' );

	$custom_kit_action = new Custom_Kit_Action( $log_email );

	$form_actions_registrar->register( $custom_kit_action );

}

add_action( 'elementor_pro/forms/actions/register', 'custom_elementor_form_actions' );
