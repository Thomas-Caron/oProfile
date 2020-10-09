<?php get_header( 'front-page' ); ?>

<main class="main">
    <?php
    $post_count = get_theme_mod(
        oProfile\Theme\Customizer\Setting\Front_Page_Post_Count::ID,
        oProfile\Theme\Customizer\Setting\Front_Page_Post_Count::DEFAULT
    );

    if ( $post_count > 0 ) :

        $last_post_query = new WP_Query(
            [
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
                'offset'         => 0,
                'posts_per_page' => $post_count
            ]
        );

        if ( $last_post_query->have_posts() ) :
        ?>
        <section class="post-list">
            <header class="post-list__header">Les articles de la communauté</header>
            <main class="post-list__content">
                <?php
                while ( $last_post_query->have_posts() ) :
                    $last_post_query->the_post();

                    get_template_part( 'template-parts/content/post-excerpt' );
                endwhile;

                wp_reset_postdata();
                ?>
            </main>
        </section>
        <?php
        endif;
    endif;

    $last_developer_query = new WP_Query(
        [
            'post_type'      => oProfile\PostType\Developer::NAME,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'offset'         => 0,
            'posts_per_page' => 6
        ]
    );

    if ( $last_developer_query->have_posts() ) :
        ?>
        <section class="client-list">
            <header class="client-list__header">Les développeurs</header>
            <main class="client-list__content">
                <?php
                while ( $last_developer_query->have_posts() ) :
                    $last_developer_query->the_post();
                    ?>
                    <article class="client-excerpt">
                        <header class="client-excerpt__title">
                            <a
                                href="<?php the_permalink(); ?>"
                            ><?php the_author(); ?></a>
                        </header>
                        <main class="client-excerpt__content">
                            <img class="client-excerpt__image" src="https://picsum.photos/100/100" alt="">
                            <p><?php the_author_meta( 'description' ) ?></p>
                        </main>
                    </article>
                    <?php
                endwhile;
                ?>
            </main>
        </section>
        <?php
        wp_reset_postdata();

    endif;


    $last_client_query = new WP_Query(
        [
            'post_type'      => oProfile\PostType\Client::NAME,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'offset'         => 0,
            'posts_per_page' => 6
        ]
    );

    if ( $last_client_query->have_posts() ) :
        ?>
        <section class="client-list">
            <header class="client-list__header">Les clients</header>
            <main class="client-list__content">
                <?php
                while ( $last_client_query->have_posts() ) :
                    $last_client_query->the_post();
                    ?>
                    <article class="client-excerpt">
                        <header class="client-excerpt__title">
                            <a
                                href="<?php the_permalink(); ?>"
                            ><?php the_author(); ?></a>
                        </header>
                        <main class="client-excerpt__content">
                            <img class="client-excerpt__image" src="https://logo.clearbit.com/github.com" alt="">
                            <p><?php the_author_meta( 'description' ) ?></p>
                        </main>
                    </article>
                    <?php
                endwhile;
                ?>
            </main>
        </section>
        <?php
        wp_reset_postdata();

    endif;
    ?>

</main>

<?php get_footer();
