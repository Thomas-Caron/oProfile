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
    ?>


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
