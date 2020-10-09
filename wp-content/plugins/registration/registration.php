<?php
/**
 * Plugin Name: Registration
 */

if (! defined('WPINC')) {
    http_response_code(404);
    exit;
}

define('OPROFILE_PLUGIN_REGISTRATION_FILE', __FILE__);

require plugin_dir_path(OPROFILE_PLUGIN_REGISTRATION_FILE) . 'vendor/autoload.php';

$router = new oProfile\Plugin\Registration\Router;
$dispatcher = new oProfile\Plugin\Registration\Dispatcher($router);

$plugin = new oProfile\Plugin\Registration\Plugin($router, $dispatcher);
$plugin->run();
