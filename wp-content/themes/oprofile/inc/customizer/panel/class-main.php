<?php

namespace oProfile\Theme\Customizer\Panel;

class Main {
    public const ID = 'oprofile';

    /**
     * Add panel
     *
     * @param \WP_Customize_Manager $wp_customize Customizer manager
     */
    public static function add( $wp_customize ) {
        $wp_customize->add_panel(
            self::ID,
            [
                'title'    => __( 'Configuration du thème oProfile' ),
                'priority' => 1
            ]
        );
    }
}
