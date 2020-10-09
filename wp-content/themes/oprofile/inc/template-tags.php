<?php

if ( ! function_exists( 'oprofile_header_class' ) ) {
    function oprofile_header_class() {
        $header_classes = [
            'header'
        ];

        if ( is_front_page() ) {
            $header_classes[] = ' header--transparent';
        }

        $header_classes = apply_filters( 'oprofile_header_classes', $header_classes );

        echo 'class="' . implode( ' ', $header_classes ) . '"';
    }
}

if ( ! function_exists( 'the_oprofile_logo' ) ) {
    function the_oprofile_logo() {
        if ( is_front_page() ) :
        ?>
            <h1 class="logo"><?php bloginfo( 'name' ); ?></h1>
        <?php
        else:
        ?>
            <a class="logo" href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a>
        <?php
        endif;
    }
}
