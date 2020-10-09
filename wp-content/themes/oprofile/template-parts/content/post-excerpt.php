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
