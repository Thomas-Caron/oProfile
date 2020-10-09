<?php

namespace oProfile\Plugin\Registration\Controller;

class UserProfileController extends CoreController
{
    /**
     * Display user profile form
     */
    public function display()
    {
        if (! is_user_logged_in()) {
            $this->redirect(wp_login_url());
        }

        $this->renderForm();
    }

    /**
     * User profile from submit
     */
    public function update()
    {
        if (! is_user_logged_in()) {
            $this->redirect(wp_login_url());
        }

        // Je vérifie le nonce afin d'éviter les attaques de type CSRF
        if (empty($_POST['_wpnonce'])) {
            $this->redirectToRoute('user_profile');
        }

        $nonce = $_POST['_wpnonce'];
        if (! wp_verify_nonce($nonce, 'user_profile')) {
            $this->redirectToRoute('user_profile');
        }

        if (empty($_POST)) {
            $this->redirectToRoute('user_profile');
        }

        $formErrors = $this->validateForm();

        if (empty($formErrors)) {
            $user = wp_get_current_user();
            $githubUrl = $_POST['github-url'];

            update_user_meta(
                $user->ID,
                'github_url',
                esc_url_raw($githubUrl)
            );

            $this->redirectToRoute('user_dashboard');
        } else {
            $formData = $_POST;

            $this->renderForm($formData, $formErrors);
        }
    }

    /**
     * Render user profile form
     *
     * @param array $formData   Form data
     * @param array $formErrors Form errors
     */
    private function renderForm(
        $formData = [],
        $formErrors = []
    )
    {
        $user = wp_get_current_user();

        $githubUrl = get_user_meta(
            $user->ID,
            'github_url',
            true
        );

        $this->render(
            'user-profile',
            [
                'user'       => $user,
                'githubUrl'  => $githubUrl,
                'formData'   => $formData,
                'formErrors' => $formErrors
            ]
        );
    }

    /**
     * Validate form
     *
     * @return array Error list
     */
    private function validateForm()
    {
        $errors = [];

        if (! filter_input(INPUT_POST, 'github-url', FILTER_VALIDATE_URL)) {
            $errors['github-url'] = 'L\'URL GitHub n\' est pas valide.';
        }

        return $errors;
    }
}
