<?php
/*
Plugin Name: Developer
Author: O'clock Fantasy
*/

if ( ! defined( 'WPINC' ) ) {
    http_response_code( 404 );
    exit;
}

require plugin_dir_path( __FILE__ ) . 'post-types/developer.php';
require plugin_dir_path( __FILE__ ) . 'taxonomies/skill.php';


// J'exécute un traitement à l'activation du plugin
if ( ! function_exists( 'developer_activation' ) ) {
    function developer_activation() {
        developer_register_post_type();

        developer_register_skill_taxonomy();

        flush_rewrite_rules();
    }
}

register_activation_hook(
    __FILE__,
    'developer_activation'
);


if ( ! function_exists( 'developer_deactivation' ) ) {
    function developer_deactivation() {
        unregister_post_type( 'developer' );

        unregister_taxonomy( 'skill' );

        flush_rewrite_rules();
    }
}

register_deactivation_hook(
    __FILE__,
    'developer_deactivation'
);
