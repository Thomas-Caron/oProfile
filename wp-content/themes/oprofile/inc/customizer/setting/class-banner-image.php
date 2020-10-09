<?php

namespace oProfile\Theme\Customizer\Setting;

use oProfile\Theme\Customizer\Section\Front_Page_Banner as Section_Front_Page_Banner;

class Banner_Image {
    /**
     * @var string
     */
    public const ID = Section_Front_Page_Banner::ID . '_image';

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
            new \WP_Customize_Media_Control(
                $wp_customize,
                self::ID,
                [
                    'section'   => Section_Front_Page_Banner::ID,
                    'label'     => 'Image',
                    'mime_type' => 'image'
                ]
            )
        );
    }
}
