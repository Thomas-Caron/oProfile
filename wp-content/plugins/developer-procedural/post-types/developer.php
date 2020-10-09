<?php

if ( ! function_exists( 'developer_register_post_type' ) ) {
    /**
     * Registers the `developer` post type.
     */
    function developer_register_post_type() {
        register_post_type( 'developer', array(
            'label'                 => 'Développeur',
            'public'                => true,
            'hierarchical'          => false,
            'show_ui'               => true,
            'show_in_nav_menus'     => true,
            'supports'              => array( 'title', 'editor' ),
            'has_archive'           => true,
            'rewrite'               => true,
            'query_var'             => true,
            'menu_position'         => null,
            'menu_icon'             => 'dashicons-admin-post',
            'show_in_rest'          => true,
            'rest_base'             => 'developer',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
        ) );
    }
}

add_action( 'init', 'developer_register_post_type' );
