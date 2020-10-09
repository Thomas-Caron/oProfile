<?php

namespace oProfile\Controller;

use oProfile\Model\Developer;
use oProfile\Model\DeveloperTechnology;

class UserTechnologyController extends CoreController
{
    public function display()
    {
        if (! is_user_logged_in()) {
            $this->redirect(wp_login_url());
        }

        if (! current_user_can('edit_developer')) {
            $this->redirectToRoute('user_dashboard');
        }

        $user = wp_get_current_user();

        $developerTechnologyModel = new DeveloperTechnology;
        $userTechnologies = $developerTechnologyModel->getTechnologiesByUserId(
            $user->ID
        );

        $technologies = get_terms(
            [
                'taxonomy'   => 'technology',
                'hide_empty' => false,
                'orderby'    => 'name',
                'order'      => 'ASC'
            ]
        );

        $levels = $developerTechnologyModel->getLevels();

        $this->render(
            'user/technology',
            [
                'userTechnologies' => $userTechnologies,
                'technologies'     => $technologies,
                'levels'           => $levels
            ]
        );
    }

    public function update()
    {
        if (! is_user_logged_in()) {
            $this->redirect(wp_login_url());
        }

        if (! current_user_can('edit_developer')) {
            $this->redirectToRoute('user_dashboard');
        }

        if (empty($_POST['_wpnonce'])) {
            $this->redirectToRoute('user_technology');
        }

        $nonce = $_POST['_wpnonce'];

        if (! wp_verify_nonce($nonce, 'user_technology')) {
            $this->redirectToRoute('user_technology');
        }

        // Valider les données reçues du formulaire, pour chaque choix
            // - Valider que la technologie sélectionnée existe bien
            // - Valider que le niveau sélectionné existe bien
            // - Valider qu'il n'y a pas de doublon de technologie

        $userTechnologies = $_POST['technologyList'];

        $user = wp_get_current_user();

        $developerId = Developer::getPostId($user->ID);


        $developerTechnologyModel = new DeveloperTechnology;

        $developerTechnologyModel->deleteDeveloperTechnologies($developerId);

        foreach ($userTechnologies as $userTechnology) {
            $developerTechnologyModel->insert(
                $developerId,
                $userTechnology['id'],
                $userTechnology['level']
            );
        }

        $this->redirectToRoute('user_dashboard');
    }
}
