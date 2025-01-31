<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

interface ILogEmail {

  public function send_email_log( string $error_message ): void;

}

/**
 * Log Email utility
 *
 * Send logs for email with `wp_mail` using SMTP protocol.
 *
 * @since 1.0.0
 */
class Log_Email implements ILogEmail {

  private string $email_provider;

  private string $email_receptor;

  public function __construct( string $email_provider, string $email_receptor ) {

    $this->email_provider = $email_provider;

    $this->email_receptor = $email_receptor;

  }

  public function send_email_log( string $error_message ): void {

    $to = $this->email_receptor;
    $subject = '[Codans] | Form Action';
    $message = 'Wordpress: ' . PHP_EOL . sanitize_text_field($error_message);
    $headers = array(
      'Content-Type'  => 'text/plain; charset=UTF-8',
      'From'          => $this->email_provider,
    );

    $sent = wp_mail( $to, $subject, $message, $headers );

    if ( ! $sent ) {
      // Error log (using a log system from Wordpress or another)
      error_log( 'Fail to send log via email: ' .  wp_mail_error_message() ); // wp_mail_error_message() catch error message from wp_mail()
      // Or, for a sofisticated treatment, you can use a more advanced logging library.
      // and returns a value to indicate the failure.
    }

  }

}
