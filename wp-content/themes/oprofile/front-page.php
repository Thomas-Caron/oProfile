<?php get_header( 'front-page' ); ?>

<main class="main">
    <?php
    $last_post_query = new WP_Query(
        [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'offset'         => 0,
            'posts_per_page' => 6
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
                ?>
                <article class="post-excerpt">
                    <header class="post-excerpt__header">
                        <h3><?php the_title(); ?></h3>
                    </header>
                    <main class="post-excerpt__content">
                        <?php
                        the_post_thumbnail(
                            'large',
                            [
                                'class' => 'post-excerpt__image'
                            ]
                        );

                        the_excerpt();
                        ?>
                    </main>
                    <footer class="post-excerpt__footer">
                        <a href="<?php the_permalink(); ?>" class="button">Lire la suite</a>
                    </footer>
                </article>
            <?php
            endwhile;

            wp_reset_postdata();
            ?>
        </main>
    </section>
    <?php endif; ?>

    <section class="client-list">
        <header class="client-list__header">Ils nous font confiance</header>
        <main class="client-list__content">
            <article class="client-excerpt">
                <header class="client-excerpt__title">GitHub</header>
                <main class="client-excerpt__content">
                    <img class="client-excerpt__image" src="https://logo.clearbit.com/github.com" alt="">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea fugiat dolor pariatur quis cupiditate odio dolorem, facilis quod alias repudiandae quam consequuntur impedit asperiores voluptas vero! Expedita dolorem nihil inventore.</p>
                </main>
            </article>
            <article class="client-excerpt">
                <header class="client-excerpt__title">Mozilla</header>
                <main class="client-excerpt__content">
                    <img class="client-excerpt__image" src="https://logo.clearbit.com/mozilla.com" alt="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, distinctio.</p>
                </main>
            </article>
            <article class="client-excerpt">
                <header class="client-excerpt__title">Twitter</header>
                <main class="client-excerpt__content">
                    <img class="client-excerpt__image" src="https://logo.clearbit.com/twitter.com" alt="">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis similique odio dolor iste sed velit.</p>
                </main>
            </article>
            <article class="client-excerpt">
                <header class="client-excerpt__title">LinkedIn</header>
                <main class="client-excerpt__content">
                    <img class="client-excerpt__image" src="https://logo.clearbit.com/linkedin.com" alt="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam reprehenderit rem et, ipsa quos alias laudantium pariatur consequuntur deleniti iure optio vitae nisi praesentium eos neque officia reiciendis tempore minus ipsam accusamus voluptate inventore beatae! Reprehenderit cupiditate illum deleniti pariatur.</p>
                </main>
            </article>
            <article class="client-excerpt">
                <header class="client-excerpt__title">Google</header>
                <main class="client-excerpt__content">
                    <img class="client-excerpt__image" src="https://logo.clearbit.com/google.com" alt="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente qui adipisci ex officia consequatur itaque amet eligendi repellat. Quod, laboriosam.</p>
                </main>
            </article>
            <article class="client-excerpt">
                <header class="client-excerpt__title">Facebook</header>
                <main class="client-excerpt__content">
                    <img class="client-excerpt__image" src="https://logo.clearbit.com/facebook.com" alt="">
                    <p>Lorem ipsum dolor sit amet.</p>
                </main>
            </article>
        </main>
    </section>

</main>

<?php get_footer();
