<?php

if ( ! function_exists( 'oprofile_theme_setup' ) ) {
    function oprofile_theme_setup() {
        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails', [ 'post' ] );
    }
}

add_action( 'after_setup_theme', 'oprofile_theme_setup' );
