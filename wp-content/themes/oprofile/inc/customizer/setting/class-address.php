<?php

namespace oProfile\Theme\Customizer\Setting;

use oProfile\Theme\Customizer\Section\Footer as Section_Footer;

class Address {
    /**
     * @var string
     */
    public const ID = Section_Footer::ID . '_address';

    /**
     * Add setting
     *
     * @param WP_Customize_Manager $wp_customize Customizer manager
     */
    public static function add( $wp_customize ) {
        $wp_customize->add_setting(
            self::ID
        );

        self::add_control( $wp_customize );
    }

    /**
     * Add control
     *
     * @param WP_Customize_Manager $wp_customize Customizer manager
     */
    private static function add_control( $wp_customize ) {
        $wp_customize->add_control(
            self::ID,
            [
                'section' => Section_Footer::ID,
                'label'   => __( 'Address' ),
                'type'    => 'textarea'
            ]
        );
    }
}
