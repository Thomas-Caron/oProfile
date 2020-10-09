<?php get_header(); ?>

<main class="main">
    <?php
    if ( have_posts() ) :
        the_post();
        ?>
    <article class="post-full">
        <header class="post-full__header">
            <h1><?php the_title(); ?></h1>
        </header>
        <main class="post-full__content">
            <div class="post-full__text">
                <?php the_content(); ?>
            </div>
        </main>
    </article>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
