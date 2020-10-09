<?php

namespace oProfile\Plugin\Registration;

use oProfile\Plugin\Registration\Controller\UserProfileController;
use oProfile\Plugin\Registration\Controller\RegistrationController;
use oProfile\Plugin\Registration\Controller\UserDashboardController;

class Plugin
{
    /**
     * Router
     *
     * @var Router
     */
    private $router;

    /**
     * Dispatcher
     *
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * Constructor
     *
     * @param Router $router Router
     * @param Dispatcher $dispatcher Dispatcher
     */
    public function __construct($router, $dispatcher)
    {
        $this->router     = $router;
        $this->dispatcher = $dispatcher;

        $this->loadRoutes();
    }

    public function loadRoutes()
    {
        require plugin_dir_path(OPROFILE_PLUGIN_REGISTRATION_FILE) . 'routes/routes.php';
    }

    public function run()
    {
        $this->registerPluginHooks();

        $this->addRegisterFormActions();

        $this->addRegistrationErrorsFilters();

        $this->addRegisterNewUserActions();
    }

    /**
     * Add register_form hook actions
     */
    private function addRegisterFormActions()
    {
        $registrationController = new RegistrationController($this->router);

        add_action(
            'register_form',
            [
                $registrationController,
                'displayPassword'
            ]
        );

        add_action(
            'register_form',
            [
                $registrationController,
                'displayGitHubURL'
            ],
            12
        );

        add_action(
            'register_form',
            [
                $registrationController,
                'displayRoles'
            ],
            11
        );
    }

    /**
     * Add registration_errors hook filters
     */
    private function addRegistrationErrorsFilters()
    {
        $registrationController = new RegistrationController($this->router);

        add_filter(
            'registration_errors',
            [
                $registrationController,
                'validatePassword'
            ]
        );

        add_filter(
            'registration_errors',
            [
                $registrationController,
                'validateGitHubURL'
            ],
            12
        );

        add_filter(
            'registration_errors',
            [
                $registrationController,
                'validateRole'
            ],
            11
        );
    }

    /**
     * Add user_register hook actions
     */
    private function addRegisterNewUserActions()
    {
        $registrationController = new RegistrationController($this->router);

        add_action(
            'register_new_user',
            [
                $registrationController,
                'addPassword'
            ]
        );

        add_action(
            'register_new_user',
            [
                $registrationController,
                'addGitHubURL'
            ]
        );

        add_action(
            'register_new_user',
            [
                $registrationController,
                'addRole'
            ]
        );

        add_action(
            'register_new_user',
            [
                $registrationController,
                'addPost'
            ]
        );
    }

    /**
     * Register activation and deactivation hooks
     */
    private function registerPluginHooks()
    {
        register_activation_hook(
            OPROFILE_PLUGIN_REGISTRATION_FILE,
            [
                $this,
                'activate'
            ]
        );

        register_deactivation_hook(
            OPROFILE_PLUGIN_REGISTRATION_FILE,
            [
                $this,
                'deactivate'
            ]
        );
    }

    /**
     * Activation treatments
     */
    public function activate()
    {
        $this->router->addRewriteRules();

        flush_rewrite_rules();
    }

    /**
     * Deactivation treatments
     */
    public function deactivate()
    {
        flush_rewrite_rules();
    }
}
