<?php

declare(strict_types=1);

namespace Codans\Utils;

use Codans\Interfaces\Utils\ILogEmail;

/**
 * Log Email utility
 *
 * Send logs for email with `wp_mail` using SMTP protocol.
 *
 * @since 1.0.0
 */
class LogEmail implements ILogEmail
{
    /**
     * The email provider that will sent message.
     *
     * @var string
     */
    private string $email_provider;

    /**
     * The email recipient that will receive the message.
     *
     * @var string
     */
    private string $email_recipient;

    public function __construct(string $email_provider, ?string $email_recipient = null)
    {
        $this->email_provider = $email_provider;
        $this->email_recipient = $email_recipient;
    }


    /**
     * Send email as log to the registered recipient.
     *
     * @access public
     * @param string $error_message
     */
    public function send_email_log(string $error_message): void
    {
        $to = $this->email_recipient;
        $subject = '[Codans] | Form Action';
        $message = 'Wordpress: ' . PHP_EOL . sanitize_text_field($error_message);
        $headers = array(
            'Content-Type' => 'text/plain; charset=UTF-8',
            'From'         => $this->email_provider,
        );

        $sent = wp_mail($to, $subject, $message, $headers);

        if (! $sent) {
            // Error log (using a log system from Wordpress or another)
            error_log('Fail to send log via email: ' .  wp_mail_error_message()); // wp_mail_error_message() catch error message from wp_mail()
            // Or, for a sofisticated treatment, you can use a more advanced logging library.
            // and returns a value to indicate the failure.
        }
    }

    /**
     * Email recipient setter.
     *
     * @access public
     * @param string $email_recipient
     */
    public function set_email_recipient(string $email_recipient): void
    {
        $this->email_recipient = $email_recipient;
    }
}
