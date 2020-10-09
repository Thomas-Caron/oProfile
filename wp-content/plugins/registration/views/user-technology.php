<?php
add_action(
    'wp_enqueue_scripts',
    function() {
        wp_enqueue_script(
            'user-technology',
            plugin_dir_url(OPROFILE_PLUGIN_REGISTRATION_FILE) . 'public/js/user-technology.js',
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
                <fieldset class="form-user-technology__fieldset technology-container">
                    <div class="form__group form-user-technology__group">
                        <label class="form__label">Technologie</label>
                        <select class="form__control" name="technologyList[0][id]">
                            <option>PHP</option>
                            <option>CSS</option>
                            <option>JavaScript</option>
                            <option>MySQL</option>
                            <option>WordPress</option>
                        </select>
                        <label class="form__label">Niveau</label>
                        <select class="form__control" name="technologyList[0][level]">
                            <option>Débutant</option>
                            <option>Confirmé</option>
                            <option>Expert</option>
                        </select>
                        <button type="button" class="button button--delete delete-technology">Supprimer</button>
                    </div>
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
            <option>PHP</option>
            <option>CSS</option>
            <option>JavaScript</option>
            <option>MySQL</option>
            <option>WordPress</option>
        </select>
        <label class="form__label">Niveau</label>
        <select class="form__control technology-level">
            <option>Débutant</option>
            <option>Confirmé</option>
            <option>Expert</option>
        </select>
        <button type="button" class="button button--delete delete-technology">Supprimer</button>
    </div>
</template>

<?php get_footer(); ?>
