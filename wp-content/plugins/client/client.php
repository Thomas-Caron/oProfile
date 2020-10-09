<?php
/*
Plugin Name: Client
*/

// Si un utilisateur appelle directement un fichier de mon plugin, j'arrête tout
if ( ! defined( 'WPINC' ) ) {
    http_response_code( 404 );
    exit;
}

define('OPROFILE_PLUGIN_CLIENT_FILE', __FILE__);

require plugin_dir_path(OPROFILE_PLUGIN_CLIENT_FILE) . 'vendor/autoload.php';

$plugin = new oProfile\Plugin\Client\Plugin;
$plugin->run();
