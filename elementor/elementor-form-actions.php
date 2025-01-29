<?php
/**
 * Plugin Name: Elementor Form Actions
 * Description: Custom addon which adds new subscriber to multiple providers after form submission.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Junior Botelho
 * Author URI:  https://github.com/juniorbotelho/
 * Text Domain: elementor-form-actions
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add new subscriber to Sendy.
 *
 * @since 1.0.0
 * @param ElementorPro\Modules\Forms\Registrars\Form_Actions_Registrar $form_actions_registrar
 * @return void
 */
function custom_elementor_form_actions( $form_actions_registrar ) {

	include_once( __DIR__ .  '/actions/email-marketing/convert-kit.php' );

	$form_actions_registrar->register( new Custom_Kit_Action() );

}

add_action( 'elementor_pro/forms/actions/register', 'custom_elementor_form_actions' );
