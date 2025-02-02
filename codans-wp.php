<?php

declare(strict_types=1);

/**
 * Plugin Name: Codans WP
 * Description: Official codans plugin that gives Wordpress superpowers to handle the company's own relationships.
 * Plugin URI:  https://github.com/juniorbotelho/codans-wp
 * Version:     1.0.0
 * Author:      Junior Botelho
 * Author URI:  https://github.com/juniorbotelho/
 * Text Domain: codans-wp
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

if (! defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Codans\Controller\{FormActionController, RedirectController};

/** @var Dotenv */
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// FormActionController::register();
RedirectController::register();
