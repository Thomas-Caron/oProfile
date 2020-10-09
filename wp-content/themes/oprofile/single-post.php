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
                <?php
                the_post_thumbnail(
                    'post-thumbnail',
                    [
                        'class' => 'post-full__image'
                    ]
                );
                ?>
                <div class="post-full__meta">
                    Par <a href="#" class="post-full__author"><?php the_author(); ?></a> le <a href="#" class="post-full__author"><time datetime="<?= get_the_date( 'Y-m-d' ); ?>"><?= get_the_date(); ?></time></a>
                </div>
                <div class="post-full__text">
                    <?php the_content(); ?>
                </div>
            </main>
        </article>
    <?php
    endif;

    //Get only the approved comments
    if ( comments_open() ) :
        $args = array(
            'status' => 'approve'
        );

        // The comment Query
        $comments_query = new WP_Comment_Query;
        $comment_list = $comments_query->query( $args );

        if ( ! empty( $comment_list ) ) :
            ?>
            <section class="comment-list">
                <header class="comment-list__header">Commentaires</header>
                <main class="comment-list__content">
                    <?php
                    foreach ( $comment_list as $comment ) :
                        $comment_date = get_comment_date(
                            get_option( 'date_format' ) . ' à ' . get_option( 'time_format' ),
                            $comment
                        );
                        ?>
                        <article class="comment">
                            <main class="comment__content"><?= esc_html( $comment->comment_content ); ?></main>
                            <footer class="comment__meta">Par <?= esc_html( $comment->comment_author ); ?> le <time datetime="<?= esc_attr( $comment->comment_date ); ?>"><?= esc_html( $comment_date ); ?></time></footer>
                        </article>
                    <?php endforeach; ?>
                </main>
            </section>
        <?php
        endif;

        if ( is_user_logged_in() ) :
            ?>
            <section class="comment-form">
                <?php
                comment_form(
                    [
                        'class_submit'   =>  'comment-form__submit button',
                        'label_submit'   => 'Envoyer',
                        'logged_in_as'   => '',
                        'title_reply'    => '<div class="comment-form__header">Commenter</div>',
                        'comment_field'  => '<textarea name="comment" class="comment-form__message"></textarea>'
                    ]
                );
                ?>
            </section>
            <?php
        endif;
    endif;
    ?>
</main>

<?php get_footer(); ?>
