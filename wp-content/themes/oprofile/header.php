<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header <?php oprofile_header_class(); ?>>
        <!--nav.menu>ul.menu__list>li.menu__list-item*2>a.menu__link[href="#"]-->
        <?php the_oprofile_logo(); ?>
        <nav class="menu menu--with-separator">
            <ul class="menu__list">
                <?php if ( is_user_logged_in() ) : ?>
                    <li class="menu__item"><a href="<?= bloginfo('url') ?>/user/dashboard" class="menu__link">Mon espace personnel</a></li>
                    <li class="menu__item"><a href="<?= wp_logout_url(); ?>" class="menu__link">Se déconnecter</a></li>
                <?php else: ?>
                    <li class="menu__item"><a href="<?= wp_login_url(); ?>" class="menu__link">Se connecter</a></li>
                    <li class="menu__item"><a href="<?= wp_registration_url(); ?>" class="menu__link">S'inscrire</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <a href="#" class="main-menu-action open-main-menu">☰</a>
    </header>
