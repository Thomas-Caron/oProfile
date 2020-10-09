<?php

namespace oProfile\Plugin\Registration\Controller;

use oProfile\Plugin\Developer\Model\DeveloperTechnology;

class UserDashboardController extends CoreController
{
    /**
     * Display dashboard
     */
    public function display()
    {
        if (! is_user_logged_in()) {
            wp_redirect(
                wp_login_url()
            );
            exit;
        }

        $user = wp_get_current_user();

        $developerTechnologyModel = new DeveloperTechnology;
        $technologies = $developerTechnologyModel->getTechnologiesByUserId(
            $user->ID
        );

        $this->render(
            'user-dashboard',
            [
                'user'         => $user,
                'technologies' => $technologies
            ]
        );
    }
}
