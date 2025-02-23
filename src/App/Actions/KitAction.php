<?php

declare(strict_types=1);

namespace Codans\App\Actions;

use ElementorPro\Modules\Forms\Classes\{Action_Base, Ajax_Handler, Form_Record};
use ElementorPro\Core\Utils;
use Elementor\{Controls_Manager, Widget_Base};
use Codans\App\Protocols\ILogEmail;

/**
 * Elementor form Kit action.
 *
 * Custom Elementor form action which adds new subscriber to Convert Kit after form submission.
 *
 * @since 1.0.0
 */
class KitAction extends Action_Base
{
    public function __construct(
        /**
         * Log email class dependency.
         *
         * @var ILogEmail
         */
        private readonly ILogEmail $log_email,
    ) {
    }

    /**
     * Get action name.
     *
     * Retrieve Kit action name.
     *
     * @since 1.0.0
     * @access public
     * @return string
     */
    public function get_name(): string
    {
        return 'custom_kit';
    }

    /**
     * Get action label.
     *
     * Retrieve Kit action label.
     *
     * @since 1.0.0
     * @access public
     * @return string
     */
    public function get_label(): string
    {
        return esc_html__('Kit', 'elementor-form-actions');
    }

    /**
     * Register action controls.
     *
     * Add input fields to allow the user to customize the action settings.
     *
     * @since 1.0.0
     * @access public
     * @param Widget_Base $widget
     */
    public function register_settings_section(Widget_Base $widget): void
    {
        $widget->start_controls_section('section_kit', [
            'label' => esc_html__('Kit', 'elementor-form-actions'),
            'condition' => [
                'submit_actions' => $this->get_name(),
            ],
        ]);

        $widget->add_control('kit_email_receptor', [
            'label'       => esc_html__('Email Receptor', 'elementor-form-actions'),
            'description' => esc_html__('Email Receptor to provide error logs when catched', 'elementor-form-actions'),
            'placeholder' => 'johndoe@example.com',
            'type'        => Controls_Manager::TEXT,
        ]);

        $widget->end_controls_section();
    }

    /**
     * Run action.
     *
     * Runs the Kit action after form submission.
     *
     * @since 1.0.0
     * @access public
     * @param Form_Record  $record
     * @param Ajax_Handler $ajax_handler
     */
    public function run(Form_Record $record): void
    {
        $settings = $record->get('form_settings');

        $receptor = $settings['kit_email_receptor'];

        if (! empty($receptor)) {
            $this->log_email->set_email_recipient($receptor);
        }

        // Get submitted form data.
        $raw_fields = $record->get('fields');

        // Normalize form data.
        $fields = [];
        foreach ($raw_fields as $id => $field) {
            $fields[$id] = $field['value'];
        }

        // Make sure the user entered an email (required by Kit to subscribe users).
        if (empty($fields['email'])) {
            $error_details = [
                'error'   => 'Email not provided!',
                'action'  => 'Stop',
                'context' => [
                    'form_fields' => $fields,
                    'cookies'     => $_COOKIE,
                ]
            ];

            $this->log_email->send_email_log(json_encode($error_details));
            return;
        }

        if (empty($fields['name'])) {
            $error_details = [
                'error'   => 'Name not provided!',
                'action'  => 'Continue',
                'context' => [
                    'name'    => $fields,
                    'cookies' => $_COOKIE,
                ]
            ];

            $this->log_email->send_email_log(json_encode($error_details));
        }

        $base_url       = 'https://web.codans.com.br';
        $personal_tag   = $this->get_personal_tag([6104041, 6058994, 6103985]);
        $personal_name  = $this->get_personal_name($fields['name']);
        // Request data based on the param list at https://web.codans.com.br/api
        $kit_data = [
            'state'   => 'Active',
            'contact' => [
                'email'       => $fields['email'],
                'phoneNumber' => $fields['telephone']
            ],
            'customField' => [
                'firstName' => $personal_name['first_name'],
                'lastName'  => $personal_name['last_name'],
            ],
            'association' => [
                'formId' => 5171332,
                'tags'   => $personal_tag,
            ],
            'siteOptions' => [
                'ipAddress' => Utils::get_client_ip(),
                'referrer'  => isset($_POST['referrer']) ? $_POST['referrer'] : '',
            ]
        ];

        // Send the request.
        $response = wp_remote_post($base_url . '/api', [
            'body'    => json_encode($kit_data),
            'headers' => [
                'Content-Type'      => 'application/json',
                'X-Forwarded-Host'  => $kit_data['siteOptions']['ipAddress'],
                'X-API-Resource'    => 'create:subscriber',
            ]
        ]);

        // Verifique se a requisição foi bem-sucedida
        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();

            // Prepare error details
            $error_details = [
                'error'   => 'Request failed',
                'context' => [
                    'response_error_message' => $error_message,
                    'kit_data'               => $kit_data,
                    'cookies'                => $_COOKIE,
                ]
            ];

            // Send the error email with the detailed context
            $this->log_email->send_email_log(json_encode($error_details));
            error_log($error_message);
        }
    }

    /**
     * On export.
     *
     * Clears Kit form settings/fields when exporting.
     *
     * @since 1.0.0
     * @access public
     * @param array $element
     */
    public function on_export(array $element): array
    {
        unset(
            $element['kit_url'],
            $element['kit_email_receptor']
        );

        return $element;
    }

    /**
     * Get personal name
     *
     * Split full name in first and last name from input target.
     *
     * @since 1.0.0
     * @access private
     * @param array $personal_name
     */
    private function get_personal_name(array $full_name): array
    {
        $personal_name = [
            'first_name' => '',
            'last_name'  => '',
        ];

        if (!empty($full_name) && is_string($full_name)) {
            $full_name = trim($full_name);
            $name_parts = explode(' ', $full_name);

            $personal_name['first_name'] = $name_parts[0];

            if (count($name_parts) > 1) {
                $personal_name['last_name'] = $name_parts[count($name_parts) - 1];
            }
        }

        return $personal_name;
    }

    /**
     * Get personal tag
     *
     * Get segmented tags from the lead behavior.
     *
     * @since 1.0.0
     * @access private
     * @param array $default_tags
     */
    private function get_personal_tag(array $default_tags): array
    {
        $final_tags = $default_tags;

        if (isset($_COOKIE['kit'])) {
            $cookie_value = $_COOKIE['kit'];
            $data         = base64_decode($cookie_value);

            if (!mb_detect_encoding($data, 'UTF-8', true)) {
                $data = mb_convert_encoding($data, 'UTF-8');
            }

            $data = json_decode($data, true);

            if (json_last_error() === JSON_ERROR_NONE && isset($data['tags'])) {
                $cookie_tags = array_column($data['tags'], 'tag');
                $final_tags  = array_merge($default_tags, $cookie_tags);
            } else {
                $error_details = [
                    'error' => 'Error while processing the cookie "kit" name',
                    'context' => [
                        'json'        => json_last_error(),
                        'json_error'  => json_last_error_msg(),
                        'data'        => $data,
                        'cookies'     => $_COOKIE,
                    ]
                ];

                $this->log_email->send_email_log(json_encode($error_details));
            }
        }

        // Returns an array without duplicated entries
        return array_values(array_unique($final_tags));
    }
}
