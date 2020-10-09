<?php get_header(); ?>

<main class="main">
    <?php
    if ( have_posts() ) :
        the_post();
        ?>
        <article class="developer-full">

            <header class="developer-full__header">
                <img class="developer-full__image" src="https://picsum.photos/1000/900" />
                <span class="developer-full__job">Devops</span>
                <span class="developer-full__location">Paris</span>
                <a href="#" class="button">Me contacter</a>
            </header>

            <main class="developer-full__content">
                <h1 class="developer-full__name"><?php the_author(); ?></h1>

                <?php the_author_meta('description'); ?>
            </main>

            <footer class="developper-full__comments">
                <section class="carousel">
                    <header class="carousel__header">Retours des clients</header>
                    <main class="carousel__content">
                        <article class="comment">
                            <main class="comment__content">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi ea soluta modi eveniet placeat harum nam autem quasi voluptates, repudiandae labore, quia culpa voluptatum impedit consequuntur ipsam molestiae magnam officia totam, ducimus ratione commodi accusamus! Unde, cum explicabo similique, dolorum placeat, totam cumque veritatis dolore ipsum quia minima nulla? Corporis!</p>
                            </main>
                        </article>
                        <article class="comment">
                            <main class="comment__content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, fugit corporis itaque iste vitae necessitatibus! Nostrum molestiae vero odit accusamus.</p>
                            </main>
                        </article>
                        <article class="comment">
                            <main class="comment__content">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum, illo perferendis optio vero molestias eligendi. Eum obcaecati, molestiae laboriosam porro explicabo ratione perferendis nulla quia magni deleniti blanditiis architecto minus vitae odit aut corrupti harum? Cumque officia sint in voluptates laboriosam, tempore nam sunt. Nobis qui repellendus officiis ducimus sunt nisi ut repellat saepe reiciendis unde voluptas ea hic tenetur quod culpa eveniet facere iste cupiditate perferendis eius, nostrum omnis magnam nemo ad. Quas voluptate earum, eius quis atque harum id ad molestias maxime, rerum quasi aspernatur? Veniam inventore, odit, rerum praesentium molestias libero suscipit aliquid eos fugiat tenetur a!</p>
                            </main>
                        </article>
                        <article class="comment">
                            <main class="comment__content">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, perferendis.</p>
                            </main>
                        </article>
                    </main>
                    <footer class="carousel__navigation"></footer>
                </section>
            </footer>

        </article>
    <?php endif; ?>

    <section class="skill-list">
        <header class="skill-list__header">Compétences</header>
        <main class="skill-list__content">
            <div class="skill">
                <h3 class="skill__title">Toujours à l'écoute</h3>
                <a href="#" class="button">Voir les détails</a>
                <p class="skill__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi unde sunt velit facilis alias recusandae quae necessitatibus explicabo asperiores.</p>
                <i class="fa fa-user skill__icon"></i>
            </div>
            <div class="skill">
                <h3 class="skill__title">Pro-actif</h3>
                <a href="#" class="button">Voir les détails</a>
                <p class="skill__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo, quis.</p>
                <i class="fa fa-arrow-right skill__icon"></i>
            </div>
            <div class="skill">
                <h3 class="skill__title">Communicant</h3>
                <a href="#" class="button">Voir les détails</a>
                <p class="skill__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo, quis.</p>
                <i class="fa fa-bullhorn skill__icon"></i>
            </div>
            <div class="skill">
                <h3 class="skill__title">Des compétences reconnues</h3>
                <a href="#" class="button">Voir les détails</a>
                <p class="skill__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo, quis.</p>
                <i class="fa fa-bullhorn skill__icon"></i>
            </div>
        </main>
    </section>

    <?php
    $developerTechnologyModel = new oProfile\Plugin\Developer\Model\DeveloperTechnology;

    $technologies = $developerTechnologyModel->getTechnologies(22);

    if (! empty( $technologies ) ) :
        ?>
        <section class="technology-list">
            <header class="technology-list__header">Mes technologies favorites</header>
            <main class="technology-list__content">
                <?php foreach ( $technologies as $technology ) :
                    /**
                     * Technology term
                     *
                     * @var \WP_Term
                     */
                    $technology_term = $technology['term'];

                    ?>
                    <article class="technology">
                        <header class="technology__title">
                            <?= esc_html( $technology_term->name ); ?>
                        </header>
                        <main class="technology__content">
                            <?php
                            $attachment_id = get_term_meta(
                                $technology_term->term_id,
                                'technology_logo',
                                true
                            );

                            if (! empty( $attachment_id )) :
                                $attachment = wp_get_attachment_image_src( $attachment_id, 'medium' );
                                ?>
                                <img
                                    class="technology__image"
                                    src="<?= $attachment[0]; ?>"
                                />
                            <?php endif; ?>
                            <p class="technology__description"><?= $technology_term->description; ?></p>
                        </main>
                        <footer>
                            <?php
                            $levelName = oProfile\Plugin\Developer\Model\DeveloperTechnology::getLevelName(
                                $technology['level']
                            );
                            ?>
                            <p>Niveau : <?= esc_html( $levelName ); ?>
                        </footer>
                    </article>
                <?php endforeach; ?>
            </main>
        </section>
        <?php
    endif;
    ?>
</main>

<?php get_footer(); ?>
