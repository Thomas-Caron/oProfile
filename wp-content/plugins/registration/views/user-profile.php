<?php get_header(); ?>

<main class="main">
    <section class="form">
        <header class="form__header"><h1>Vos informations personnelles</h1></header>
        <main class="form__content">
            <form action="<?= $router->generate('user_profile_update'); ?>" method="post">
                <?php wp_nonce_field('user_profile'); ?>
                <div class="form__group">
                    <?php
                    if (isset($formErrors['github-url'])) :
                        ?>
                        <div class="form__error"><?= $formErrors['github-url']; ?></div>
                        <?php
                    endif;
                    ?>
                    <label class="form__label" for="github-url">URL GitHub</label>
                    <input
                        class="form__control"
                        type="url"
                        id="github-url"
                        name="github-url"
                        <?php if (empty($formData['github-url'])) : ?>
                            value="<?= $githubUrl; ?>"
                        <?php else: ?>
                            value="<?= $formData['github-url']; ?>"
                        <?php endif; ?>
                    />
                </div>
                <button class="button" type="submit">Mettre à jour</button>
                <a
                    class="button"
                    href="<?= $router->generate('user_dashboard'); ?>"
                >Annuler</a>
            </form>
        </main>
    </section>
</main>

<?php get_footer(); ?>
