<?php
/*
Plugin Name: Developer
Author: O'clock Fantasy
*/

if ( ! defined( 'WPINC' ) ) {
    http_response_code( 404 );
    exit;
}

define( 'OPROFILE_DEVELOPER_PLUGIN_FILE', __FILE__ );

require plugin_dir_path(OPROFILE_DEVELOPER_PLUGIN_FILE) . 'vendor/autoload.php';

$plugin = new oProfile\Plugin\Developer\Plugin;
$plugin->run();
