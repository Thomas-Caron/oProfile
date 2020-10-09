    <footer class="footer">
        <dl class="footer__contact-list">
            <dt class="footer__contact-key footer__contact-key--email">Email</dt>
            <dd class="footer__contact-value">hey@oprofiles.local</dd>
            <dt class="footer__contact-key footer__contact-key--phone">Téléphone</dt>
            <dd class="footer__contact-value">+33 1 23 45 67</dd>
            <dt class="footer__contact-key footer__contact-key--address">Adresse</dt>
            <dd class="footer__contact-value">55 rue du Faubourg Saint-Honoré 75008 Paris</dd>
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
