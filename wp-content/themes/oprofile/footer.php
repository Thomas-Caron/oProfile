    <footer class="footer">
        <dl class="footer__contact-list">
            <?php
            $email = get_theme_mod( oProfile\Theme\Customizer\Setting\Email::ID );

            if ( ! empty( $email ) ) :
                ?>
                <dt class="footer__contact-key footer__contact-key--email">Email</dt>
                <dd class="footer__contact-value"><a class="footer__contact-link" href="mailto:<?= esc_attr( $email ); ?>"><?= esc_html( $email ); ?></a></dd>
                <?php
            endif;

            $phone = get_theme_mod( oProfile\Theme\Customizer\Setting\Phone::ID );

            if ( ! empty( $phone ) ) :
                ?>
                <dt class="footer__contact-key footer__contact-key--phone">Téléphone</dt>
                <dd class="footer__contact-value"><a class="footer__contact-link" href="tel: <?= esc_attr( $phone ); ?>"><?= esc_html( $phone ); ?></a></dd>
                <?php
            endif;

            $address = get_theme_mod( oProfile\Theme\Customizer\Setting\Address::ID );

            if ( ! empty( $address ) ) :
                ?>
                <dt class="footer__contact-key footer__contact-key--address">Adresse</dt>
                <dd class="footer__contact-value"><?= nl2br( esc_html( $address ) ); ?></dd>
                <?php
            endif;
            ?>
        </dl>
        <?php
        wp_nav_menu(
            [
                'theme_location'  => 'footer-menu',
                'container'       => 'nav',
                'container_class' => 'menu menu--two-columns',
                'menu_class'      => 'menu__list'
            ]
        );

        wp_nav_menu(
            [
                'theme_location'  => 'social-menu',
                'container'       => 'nav',
                'container_class' => 'menu',
                'menu_class'      => 'menu__list',
                'fallback_cb'     => '__return false'
            ]
        );
        ?>
        <!-- <nav class="menu">
            <ul class="menu__list">
                <li class="menu__item"><a href="#" class="menu__link"><i class="fa fa-twitter" aria-hidden="true" title="Twitter"></i></a></li>
                <li class="menu__item"><a href="#" class="menu__link"><i class="fa fa-facebook" aria-hidden="true" title="Facebook"></i></a></li>
                <li class="menu__item"><a href="#" class="menu__link"><i class="fa fa-instagram" aria-hidden="true" title="Instagram"></i></a></li>
                <li class="menu__item"><a href="#" class="menu__link"><i class="fa fa-github" aria-hidden="true" title="GitHub"></i></a></li>
            </ul>
        </nav> -->
    </footer>
    <div class="overlay main-menu">
        <a href="#" class="main-menu-action close-main-menu">❌</a>
        <?php
        wp_nav_menu(
            [
                'theme_location'  => 'main-menu',
                'container'       => 'nav',
                'container_class' => 'menu menu--vertical',
                'menu_class'      => 'menu__list'
            ]
        );

        wp_nav_menu(
            [
                'theme_location'  => 'social-menu',
                'container'       => 'nav',
                'container_class' => 'menu',
                'menu_class'      => 'menu__list',
                'fallback_cb'     => '__return false'
            ]
        );
        ?>
    </div>

    <?php wp_footer(); ?>
</body>

</html>
