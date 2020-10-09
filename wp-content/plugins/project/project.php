<?php
/**
 * Plugin Name: Project
 * Author: O'clock Fantasy
 * Version: 1.0
 */

if (! defined('WPINC')) {
    http_response_code(404);
    exit;
}

define('OPROFILE_PLUGIN_PROJECT_VERSION', '1.0');
define('OPROFILE_PLUGIN_PROJECT_FILE', __FILE__);

require plugin_dir_path(OPROFILE_PLUGIN_PROJECT_FILE) . 'vendor/autoload.php';

$plugin = new oProfile\Plugin\Project\Plugin;
$plugin->run();
