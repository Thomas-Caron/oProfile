<?php
/**
 * Plugin Name: oProfile
 * Author: O'clock Fantasy
 * Author URI: https://github.com/O-clock-Fantasy
 * Version: 1.0
 */

if (! defined('WPINC')) {
    http_response_code(404);
    exit;
}

define('OPROFILE_PLUGIN_VERSION', '1.0');
define('OPROFILE_PLUGIN_FILE', __FILE__);

require plugin_dir_path(OPROFILE_PLUGIN_FILE) . 'vendor/autoload.php';

$router = new oProfile\Router;
$dispatcher = new oProfile\Dispatcher($router);

$plugin = new oProfile\Plugin($router, $dispatcher);
$plugin->run();
