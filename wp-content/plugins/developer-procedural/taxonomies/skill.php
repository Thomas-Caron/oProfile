<?php

if ( ! function_exists( 'developer_register_skill_taxonomy' ) ) {
    function developer_register_skill_taxonomy() {
        register_taxonomy(
            'skill',
            'developer',
            [
                'label'        => 'Compétence',
                'public'       => true,
                'hierarchical' => false,
                'show_in_rest' => true
            ]
        );
    }
}

add_action( 'init', 'developer_register_skill_taxonomy' );
