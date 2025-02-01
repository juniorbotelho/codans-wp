<?php

namespace Codans\Native\Hook;

/**
 * Act as a mediator, redirecting to url and saving user track to cookie.
 *
 * @since 1.0.0
 * @return void
 */
function codans_smart_redirect(): void
{
}

add_action('wp_footer', 'codans_smart_redirect');
