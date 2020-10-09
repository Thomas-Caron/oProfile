<?php get_header(); ?>

<main class="main">
    <?php if ( have_posts() ) : ?>
        <section class="post-list">
            <header class="post-list__header">
                <h1><?php the_archive_title(); ?><h1>
            </header>
            <main class="post-list__content">
                <?php
                while ( have_posts() ) :
                    the_post();

                    get_template_part( 'template-parts/content/post-excerpt' );
                endwhile;
                ?>
            </main>
        </section>
        <nav class="pagination">
            <a href="#" class="pagination__link button button--previous">Contenus plus récents</a>
            <a href="#" class="pagination__link button">Contenus plus anciens</a>
        </nav>
    <?php endif; ?>
</main>

<?php
get_footer();
