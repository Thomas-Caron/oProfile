<?php

if ( ! function_exists( 'oprofile_register_nav_menus' ) ) {
    function oprofile_register_nav_menus() {
        register_nav_menus(
            [
                'footer-menu' => __( 'Menu du pied de page' ),
                'main-menu'   => __( 'Menu principal' ),
                'social-menu' => __( 'Menu des réseaux sociaux' )
            ]
        );
    }
}

add_action( 'init', 'oprofile_register_nav_menus' );


if ( ! function_exists( 'oprofile_menu_li_classes' ) ) {
    function oprofile_menu_li_classes( $classes ) {
        $classes[] = 'menu__item';

        return $classes;
    }
}

add_filter(
    'nav_menu_css_class',
    'oprofile_menu_li_classes'
);


if ( ! function_exists( 'oprofile_menu_link_classes' ) ) {
    function oprofile_menu_link_classes( $attributes ) {
        // Je fais en sorte d'avoir toujours une chaîne de caractères dans l'attribut class...
        if ( empty( $attributes[ 'class' ] ) ) {
            $attributes[ 'class' ] = '';
        }

        // ... de manière à pouvoir concaténer dans tous les cas
        $attributes[ 'class' ] .= ' menu__link';

        // Je nettoie les espaces inutiles
        $attributes[ 'class' ] = trim( $attributes[ 'class' ] );

        return $attributes;
    }
}

add_filter(
    'nav_menu_link_attributes',
    'oprofile_menu_link_classes'
);
