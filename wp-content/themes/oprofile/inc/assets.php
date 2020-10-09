<?php

if ( ! function_exists( 'oprofile_enqueue_scripts' ) ) {
    function oprofile_enqueue_scripts() {
        wp_enqueue_style(
            'oprofile-style',
            get_theme_file_uri( 'src/dist/main.css' ),
            [],
            OPROFILE_THEME_VERSION
        );

        wp_enqueue_script(
            'oprofile-script',
            get_theme_file_uri( 'src/dist/main.js' ),
            [],
            OPROFILE_THEME_VERSION,
            true
        );
    }
}

add_action( 'wp_enqueue_scripts', 'oprofile_enqueue_scripts' );
