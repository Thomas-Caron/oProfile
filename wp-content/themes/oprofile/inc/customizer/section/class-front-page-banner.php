<?php

namespace oProfile\Theme\Customizer\Section;

use oProfile\Theme\Customizer\Panel\Main as Panel_Main;

class Front_Page_Banner {
    public const ID = Panel_Main::ID . '_frontpage_banner';

    /**
     * Add section
     *
     * @param WP_Customize_Manager $wp_customize Customizer manager
     */
    public static function add( $wp_customize ) {
        $wp_customize->add_section(
            self::ID,
            [
                'panel' => Panel_Main::ID,
                'title' => __( 'Bannière de la page d\'accueil' )
            ]
        );
    }
}
