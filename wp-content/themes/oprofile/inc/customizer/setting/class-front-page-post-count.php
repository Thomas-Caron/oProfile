<?php

namespace oProfile\Theme\Customizer\Setting;

use oProfile\Theme\Customizer\Section\Front_Page as Section_Front_Page;

class Front_Page_Post_Count {
    /**
     * @var string
     */
    public const ID = Section_Front_Page::ID . '_postcount';

    /**
     * @var int
     */
    public const DEFAULT = 6;

    /**
     * Add setting
     *
     * @param WP_Customize_Manager $wp_customize Customizer manager
     */
    public static function add( $wp_customize ) {
        $wp_customize->add_setting(
            self::ID,
            [
                'default'           => self::DEFAULT,
                'validate_callback' => [ self::class, 'validate' ]
            ]
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
                'section'     => Section_Front_Page::ID,
                'label'       => __( 'Nombre d\'articles de blog' ),
                'type'        => 'number',
                'input_attrs' => [
                    'min'  => 0,
                    'step' => 2
                ]
            ]
        );
    }

    /**
     * Validate email address
     *
     * @param \WP_Error $validity  Validation object
     * @param string   $post_count Post count to validate
     *
     * @return \WP_Error Validation object
     */
    public static function validate( $validity, $post_count ) {
        if ( ! is_numeric( $post_count ) ) {
            $validity->add(
                'invalid_type',
                __( 'Le nombre de post doit être numérique.' )
            );
        }

        $post_count = intval( $post_count );

        if ( $post_count < 0 ) {

            $validity->add(
                'negative_number',
                __( 'Le nombre de post doit être positif.' )
            );

        }

        if ( $post_count % 2 === 1 ) {

            $validity->add(
                'odd_number',
                __( 'Le nombre de post doit pair.' )
            );

        }

        return $validity;
    }
}
