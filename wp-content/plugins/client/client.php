<?php
/*
Plugin Name: Client
*/

// Si un utilisateur appelle directement un fichier de mon plugin, j'arrête tout
if ( ! defined( 'WPINC' ) ) {
    http_response_code( 404 );
    exit;
}

require plugin_dir_path( __FILE__ ) . 'post-type.php';

// J'exécute un traitement à l'activation du plugin
if ( ! function_exists( 'client_activation' ) ) {
    function client_activation() {
        // Comme WordPress n'exécute pas le hook init lors de l'activation d'un plugin, il faut que je recrée mon post type en exécutant la fonction avant de recharger les permaliens (les routes)
        client_register_post_type();

        // Attention, cette fonction est coûteuse en terme de traitement
        flush_rewrite_rules();
    }
}

register_activation_hook(
    __FILE__,
    'client_activation'
);


if ( ! function_exists( 'client_deactivation' ) ) {
    function client_deactivation() {
        // Je supprime le type de contenu client...
        unregister_post_type( 'client' );

        // ... avant de recharger le permaliens (les routes)
        flush_rewrite_rules();
    }
}

register_deactivation_hook(
    __FILE__,
    'client_deactivation'
);
