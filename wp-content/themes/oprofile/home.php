<?php get_header(); ?>

<main class="main">
    <?php if ( have_posts() ) : ?>
    <section class="post-list">
        <header class="post-list__header">
            <h1>Les derniers articles publiés<h1>
        </header>
        <main class="post-list__content">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article class="post-excerpt">
                    <header class="post-excerpt__header">
                        <h2><?php the_title(); ?></h2>
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
            <?php endwhile; ?>
        </main>
    </section>
    <nav class="pagination">
        <a href="#" class="pagination__link button button--previous">Contenus plus récents</a>
        <a href="#" class="pagination__link button">Contenus plus anciens</a>
    </nav>
    <?php endif; ?>
</main>

<?php get_footer();
