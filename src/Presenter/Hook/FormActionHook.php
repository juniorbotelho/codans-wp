<?php

declare(strict_types=1);

namespace Codans\Presenter\Hook;

use ElementorPro\Modules\Forms\Registrars\Form_Actions_Registrar;
use Codans\App\Actions\KitAction;
use Codans\Edge\Helpers\LogEmail;

class FormActionHook
{
    /**
     * Register the action hook.
     *
     * @since 1.0.0
     * @return void
     */
    public static function register(): void
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

        $log_email			= new LogEmail($email_provider, $email_receptor);
        $custom_kit_action	= new KitAction($log_email);

        $form_actions_registrar->register($custom_kit_action);
    }
}
