<?php

if ( ! function_exists( 'client_register_post_type' ) ) {
    function client_register_post_type() {
        register_post_type(
            'client',
            [
                'label'        => 'Client',
                'public'       => true,
                'hierarchical' => false,
                'show_in_rest' => true
            ]
        );
    }
}

add_action( 'init', 'client_register_post_type' );
