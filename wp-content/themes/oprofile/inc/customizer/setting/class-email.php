<?php

namespace oProfile\Theme\Customizer\Setting;

use oProfile\Theme\Customizer\Section\Footer as Section_Footer;

class Email {
    /**
     * @var string
     */
    public const ID = Section_Footer::ID . '_email';

    /**
     * Add setting
     *
     * @param WP_Customize_Manager $wp_customize Customizer manager
     */
    public static function add( $wp_customize ) {
        $wp_customize->add_setting(
            self::ID,
            [
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
                'section' => Section_Footer::ID,
                'label'   => __( 'E-mail' ),
                'type'    => 'email'
            ]
        );
    }

    /**
     * Validate email address
     *
     * @param \WP_Error $validity Validation object
     * @param string   $email    Email to validate
     *
     * @return \WP_Error Validation object
     */
    public static function validate( $validity, $email ) {
        if ( ! empty ( $email ) ) {
            if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
                $validity->add(
                    'invalid_email',
                    __( 'L\' email est invalide.' )
                );
            }
        }

        return $validity;
    }
}
