<?php
add_action(
    'wp_enqueue_scripts',
    function() {
        wp_enqueue_script(
            'user-technology',
            plugin_dir_url(OPROFILE_PLUGIN_FILE) . 'public/js/user-technology.js',
            [],
            false,
            true
        );
    }
);

get_header();
?>

<main class="main">
    <div class="form form-user-technology">
        <header class="form__header"><h1>Mes technologies</h1></header>
        <main class="form__content">
            <form action="<?= $router->generate('user_technology_update'); ?>" method="post">
                <?php wp_nonce_field('user_technology'); ?>
                <fieldset class="form-user-technology__fieldset technology-container">
                    <?php
                    if (! empty($userTechnologies)) :
                        foreach ($userTechnologies as $userTechnology) :
                            ?>
                            <?php
                        endforeach;
                    endif;
                    ?>
                    <a
                        href="#"
                        class="button button--plus add-technology"
                    >Ajouter une technologie</a>
                </fieldset>

                <button type="submit" class="button">Envoyer</button>
                <a href="<?= $router->generate('user_dashboard'); ?>" class="button button--cancel">Annuler</a>
            </form>
        </main>
    </div>
</main>

<template id="technology-template">
    <div class="form__group form-user-technology__group">
        <label class="form__label">Technologie</label>
        <select class="form__control technology-id">
            <?php foreach ($technologies as $technology) : ?>
                <option
                    value="<?= esc_attr($technology->term_id); ?>"
                ><?= esc_html($technology->name); ?></option>
            <?php endforeach; ?>
        </select>
        <label class="form__label">Niveau</label>
        <select class="form__control technology-level">
            <?php foreach ($levels as $levelId => $levelName) : ?>
                <option
                    value="<?= esc_attr($levelId); ?>"
                ><?= esc_html($levelName); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" class="button button--delete delete-technology">Supprimer</button>
    </div>
</template>

<?php get_footer(); ?>
