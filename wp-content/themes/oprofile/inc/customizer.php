<?php

if ( ! function_exists( 'oprofile_customize_register' ) ) {
    /**
     * Configure WordPress Customizer
     *
     * @param WP_Customize_Manager $wp_customize Customizer configuration object
     */
    function oprofile_customize_register( $wp_customize ) {
        $wp_customize->add_panel(
            'oprofile',
            [
                'title'    => 'Configuration du thème oProfile',
                'priority' => 1
            ]
        );

        $wp_customize->add_section(
            'oprofile_frontpage',
            [
                'panel' => 'oprofile',
                'title' => 'Page d\'accueil'
            ]
        );

        $wp_customize->add_setting(
            'oprofile_frontpage_banner_title'
        );

        $wp_customize->add_control(
            'oprofile_frontpage_banner_title',
            [
                'section' => 'oprofile_frontpage',
                'label'   => 'Titre de la bannière',
                'type'    => 'text'
            ]
        );


        $wp_customize->add_setting(
            'oprofile_frontpage_banner_description'
        );

        $wp_customize->add_control(
            'oprofile_frontpage_banner_description',
            [
                'section' => 'oprofile_frontpage',
                'label'   => 'Description de la bannière',
                'type'    => 'textarea'
            ]
        );


        $wp_customize->add_setting(
            'oprofile_frontpage_banner_image'
        );

        $wp_customize->add_control(
            new WP_Customize_Media_Control(
                $wp_customize,
                'oprofile_frontpage_banner_image',
                [
                    'section'   => 'oprofile_frontpage',
                    'label'     => 'Image de la bannière',
                    'mime_type' => 'image'
                ]
            )
        );
    }
}

add_action( 'customize_register', 'oprofile_customize_register' );
