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
                <li class="menu__item"><a href="#" class="menu__link">Se connecter</a></li>
                <li class="menu__item"><a href="#" class="menu__link">S'inscrire</a></li>
            </ul>
        </nav>
        <a href="#" class="main-menu-action open-main-menu">☰</a>
    </header>
