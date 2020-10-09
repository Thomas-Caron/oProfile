<?php

get_header();

$banner_title = get_theme_mod( 'oprofile_frontpage_banner_title' );
$banner_description = get_theme_mod( 'oprofile_frontpage_banner_description' );
$banner_image_id = get_theme_mod( 'oprofile_frontpage_banner_image' );
?>
<section
    class="banner"
    <?php
    if ( ! empty( $banner_image_id ) ) :
        $banner_image = wp_get_attachment_image_src(
            $banner_image_id,
            'post-thumbnail'
        );

        $banner_image_url = $banner_image[0];
        ?>
        style="background-image: url(<?= $banner_image_url; ?>);"
    <?php endif; ?>
>
    <header class="banner__title">
        <?php
        if ( empty( $banner_title ) ) :
            echo 'Bienvenue sur oProfiles';
        else :
            echo $banner_title;
        endif;
        ?>
    </header>
    <main class="banner__content">
        <?php
        if ( empty( $banner_description ) ) :
            echo 'Le site de partage de profils de développeurs Web. Viens toi aussi participer à la communauté des oProfilers&#x2026;';
        else:
            echo $banner_description;
        endif;
        ?>
    </main>
    <footer class="banner__actions">
        <a href="#" class="button">Les profils</a>
        <a href="<?= get_post_type_archive_link( 'post' ); ?>" class="button">Le blog de la communauté</a>
    </footer>
</section>
