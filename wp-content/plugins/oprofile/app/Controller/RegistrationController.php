<?php

namespace oProfile\Controller;

use oProfile\Role\Client    as RoleClient;
use oProfile\Role\Developer as RoleDeveloper;

class RegistrationController extends CoreController
{
    /**
     * Display password in registration form
     */
    public function displayPassword()
    {
        $this->render('registration/password');
    }

    /**
     * Validate password from registration form
     *
     * @param \WP_Error $errors Error manager
     *
     * @return \WP_Error Updated error manager
     */
    public function validatePassword($errors)
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

        return $errors;
    }

    /**
     * Add password in database from registration form
     *
     * @param int $userId User ID
     */
    public function addPassword($userId)
    {
        $password = $_POST['password'];

        wp_set_password($password, $userId);
    }

    public function displayGitHubURL()
    {
        $formData = [];

        if (! empty($_POST)) {
            $formData = $_POST;
        }

        $this->render(
            'registration/github-url',
            [
                'formData' => $formData
            ]
        );
    }

    /**
     * Validate GitHub URL from registration form
     *
     * @param \WP_Error $errors Error manager
     *
     * @return \WP_Error Updated error manager
     */
    public function validateGitHubURL($errors)
    {
        if (! empty($_POST['github-url'])) {
            $githubUrl = strval($_POST['github-url']);

            if (! filter_var($githubUrl, FILTER_VALIDATE_URL)) {
                $errors->add(
                    'invalid_github_url',
                    __('<strong>Erreur</strong> : L\'URL GitHub est invalide.')
                );
            }
        }

        return $errors;
    }

    /**
     * Add GitHub URL in database from registration form
     *
     * @param int $userId User ID
     */
    public function addGitHubURL($userId)
    {
        if (! empty($_POST['github-url'])) {
            $githubUrl = strval($_POST['github-url']);

            $githubUrl = trim($githubUrl);

            add_user_meta(
                $userId,
                'github_url',
                esc_url_raw($githubUrl)
            );
        }
    }

    public function displayRoles()
    {
        $roles = $this->getRoles();

        $formData = [];

        if (! empty($_POST)) {
            $formData = $_POST;
        }

        $this->render(
            'registration/roles',
            [
                'roles'    => $roles,
                'formData' => $formData
            ]
        );
    }

    /**
     * Validate role from registration form
     *
     * @param \WP_Error $errors Error manager
     *
     * @return \WP_Error Updated error manager
     */
    public function validateRole($errors)
    {
        $roles = $this->getRoles();

        if (! empty($roles)) {
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

        // La meilleure solution serait d'avoir deux formulaires distincts pour gérer le rôle (ne pas avoir d'input permettant de sélectionner le rôle)
        if ($_POST['role'] === 'administrator') {
            $errors->add(
                'administrator_role',
                __('<strong>Erreur</strong> : Ma vengeance sera terrible.')
            );
        }

        return $errors;
    }

    /**
     * Add role in database from registration form
     *
     * @param int $userId User ID
     */
    public function addRole($userId)
    {
        $roles = $this->getRoles();

        if (! empty($roles)) {
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

    /**
     * Get roles
     *
     * @return array List of roles
     */
    private function getRoles()
    {
        $roles = [
            RoleClient::NAME    => RoleClient::DISPLAY_NAME,
            RoleDeveloper::NAME => RoleDeveloper::DISPLAY_NAME
        ];

        return $roles;
    }

    /**
     * Add user post
     *
     * @param int $userId User ID
     */
    public function addPost($userId)
    {
        $post_type = strval($_POST['role']);

        $user = get_user_by('ID', $userId);

        wp_insert_post(
            [
                'post_author' => $user->ID,
                'post_title'  => $user->user_login,
                'post_type'   => $post_type,
                'post_status' => 'publish'
            ]
        );
    }
}
