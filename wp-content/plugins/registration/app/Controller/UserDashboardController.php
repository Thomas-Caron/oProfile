<?php

namespace oProfile\Plugin\Registration\Controller;

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

        $this->render(
            'user-dashboard',
            [
                'user' => $user
            ]
        );
    }
}
