<?php get_header(); ?>

<main class="main">
    <section class="block">
        <header class="block__header"><h1>Tableau de bord</h1></header>
        <main class="block__content">
            <p>Bonjour <?= esc_html($user->display_name); ?> !</p>
            <a href="<?= $router->generate('user_profile'); ?>">Modifier mon profil</a>
        </main>
    </section>

    <section class="block">
        <header class="block__header">
            Mes technologies favorites
            <a href="<?= $router->generate('user_technology'); ?>"><i class="fa fa-edit"></i></a>
        </header>
        <main class="block__content">
            <?php if (! empty($technologies)): ?>
                <ul>
                    <?php foreach ($technologies as $technology) : ?>
                        <li><?= esc_html($technology['technologyName']); ?> (<?= esc_html($technology['levelName']); ?>)</li>
                    <?php endforeach; ?>
                <ul>
            <?php else: ?>
                <p>Il n'y a aucune technologie sélectionnée. En <a href="<?= $router->generate('user_technology'); ?>">ajouter</a>.</p>
            <?php endif; ?>
        </main>
        <footer>
        </footer>
    </section>

    <section class="block">
        <header class="block__header">
            Mes projets
        </header>
        <main class="block__content">
        </main>
        <footer>
        </footer>
    </section>
</main>

<?php get_footer(); ?>
