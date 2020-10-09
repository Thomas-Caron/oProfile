<?php

namespace oProfile\Plugin\Registration;

class Plugin
{
    public function run()
    {
        $this->addRegistrationFormActions();

        $this->addRegistrationErrorsFilters();

        $this->addRegisterNewUserActions();
    }

    /**
     * Add registration_form hook actions
     */
    private function addRegistrationFormActions()
    {
        add_action(
            'register_form',
            [
                $this,
                'displayAdditonnalFields'
            ]
        );
    }

    /**
     * Display registration form additionnal fields
     */
    public function displayAdditonnalFields()
    {
        require plugin_dir_path(OPROFILE_PLUGIN_REGISTRATION_FILE) . 'templates/registration-fields.php';
    }

    /**
     * Add registration_errors hook filters
     */
    private function addRegistrationErrorsFilters()
    {
        add_filter(
            'registration_errors',
            [
                $this,
                'validateAdditionnalFields'
            ]
        );
    }

    /**
     * Validate additionnal fields
     *
     * @param \WP_Error $errors
     *
     * @return \WP_Error
     */
    public function validateAdditionnalFields($errors)
    {
        if (empty($_POST['password'])) {
            $errors->add(
                'empty_password',
                __('<strong>Erreur</strong> : Le mot de passe doit être renseigné.')
            );
        } else {
            $password = strval($_POST['password']);

            if (strlen($password) < 6) {
                $errors->add(
                    'too_short_password',
                    __('<strong>Erreur</strong> : Le mot de passe doit dépasser les 6 caractères.')
                );
            }

            // Validation de la confirmation du mot de passe
            if (empty($_POST['password-confirmation'])) {
                $errors->add(
                    'empty_password_confirmation',
                    __('<strong>Erreur</strong> : La confirmation du mot de passe n\'est pas correcte.')
                );
            } else {
                $passwordConfirmation = strval($_POST['password-confirmation']);

                if ($password !== $passwordConfirmation) {
                    $errors->add(
                        'invalid_password_confirmation',
                        __('<strong>Erreur</strong> : La confirmation du mot de passe n\'est pas identique au mot de passe.')
                    );
                }
            }
        }

        if (! empty($_POST['github-url'])) {
            $githubUrl = strval($_POST['github-url']);

            if (! filter_var($githubUrl, FILTER_VALIDATE_URL)) {
                $errors->add(
                    'invalid_github_url',
                    __('<strong>Erreur</strong> : L\'URL GitHub est invalide.')
                );
            }
        }

        if (has_filter('oprofile_registration_roles')) {
            $roles = apply_filters('oprofile_registration_roles', []);

            if (empty($_POST['role'])) {
                $errors->add(
                    'empty_role',
                    __('<strong>Erreur</strong> : Le rôle est obligatoire.')
                );
            } else {
                $role = strval($_POST['role']);

                if (! array_key_exists($role, $roles)) {
                    $errors->add(
                        'invalid_role',
                        __('<strong>Erreur</strong> : Le rôle est invalide.')
                    );
                }
            }
        }

        return $errors;
    }

    /**
     * Add user_register hook actions
     */
    private function addRegisterNewUserActions()
    {
        add_action(
            'register_new_user',
            [
                $this,
                'registerAdditionnalFields'
            ]
        );
    }

    /**
     * Register additionnal fields
     *
     * @param int $userId User ID
     */
    public function registerAdditionnalFields($userId)
    {
        $password = $_POST['password'];

        wp_set_password($password, $userId);

        if (! empty($_POST['github-url'])) {
            $githubUrl = strval($_POST['github-url']);

            add_user_meta(
                $userId,
                'github_url',
                esc_url_raw($githubUrl)
            );
        }

        if (! empty($_POST['role'])) {
            $role = strval($_POST['role']);
             /**
              * @var \WP_User
              */
            $user = get_user_by('ID', $userId);

            if ($user) {
                $user->remove_role('subscriber');
                $user->add_role($role);

                // $user->set_role($role);
            }
        }
    }
}
