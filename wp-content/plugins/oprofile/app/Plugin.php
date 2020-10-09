<?php

namespace oProfile;

use oProfile\Controller\RegistrationController;
use oProfile\PostType\Client    as PostTypeClient;
use oProfile\PostType\Developer as PostTypeDeveloper;
use oProfile\PostType\Project   as PostTypeProject;

use oProfile\Taxonomy\ActivityArea as TaxonomyActivityArea;
use oProfile\Taxonomy\Skill        as TaxonomySkill;
use oProfile\Taxonomy\Technology   as TaxonomyTechnology;

use oProfile\Role\Client    as RoleClient;
use oProfile\Role\Developer as RoleDeveloper;

use oProfile\Model\DeveloperTechnology as ModelDeveloperTechnology;

class Plugin
{
    /**
     * Post type classes
     *
     * @var array
     */
    private const POST_TYPE_CLASSES = [
        PostTypeClient::class,
        PostTypeDeveloper::class,
        PostTypeProject::class
    ];

    /**
     * Taxonomies classes
     *
     * @var array
     */
    private const TAXONOMY_CLASSES = [
        TaxonomyActivityArea::class,
        TaxonomySkill::class,
        TaxonomyTechnology::class
    ];

    /**
     * Roles classes
     *
     * @var array
     */
    private const ROLE_CLASSES = [
        RoleClient::class,
        RoleDeveloper::class
    ];

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

    /**
     * Load routes
     */
    private function loadRoutes()
    {
        require plugin_dir_path(OPROFILE_PLUGIN_FILE) . 'routes/routes.php';
    }

    /**
     * Plugin init tasks
     */
    public function run()
    {
        $this->registerPluginHooks();

        $this->addInitActions();

        $this->addRegistrationHooks();
    }

    /**
     * Add init hook actions
     */
    private function addInitActions()
    {
        $actions = [
            [
                $this,
                'registerPostTypes',
            ],
            [
                $this,
                'registerTaxonomies'
            ]
        ];

        foreach ($actions as $action) {
            add_action(
                'init',
                $action
            );
        }
    }

    /**
     * Add registration actions and filters
     */
    private function addRegistrationHooks()
    {
        $registrationController = new RegistrationController($this->router);
        $registerFormActions = [
            'displayPassword',
            'displayRoles',
            'displayGitHubURL'
        ];

        foreach ($registerFormActions as $action) {
            add_action(
                'register_form',
                [
                    $registrationController,
                    $action
                ]
            );
        }

        $registrationErrorsFilters = [
            'validatePassword',
            'validateRole',
            'validateGitHubURL'
        ];

        foreach ($registrationErrorsFilters as $filter) {
            add_filter(
                'registration_errors',
                [
                    $registrationController,
                    $filter
                ]
            );
        }

        $registerNewUserActions = [
            'addPassword',
            'addRole',
            'addGitHubURL',
            'addPost'
        ];

        foreach ($registerNewUserActions as $action) {
            add_action(
                'register_new_user',
                [
                    $registrationController,
                    $action
                ]
            );
        }
    }

    /**
     * Register post types
     */
    public function registerPostTypes()
    {
        foreach (self::POST_TYPE_CLASSES as $postTypeClass) {
            $postType = new $postTypeClass;
            $postType->register();
        }
    }

    /**
     * Unregister post types
     */
    private function unregisterPostTypes()
    {
        foreach (self::POST_TYPE_CLASSES as $postTypeClass) {
            $postType = new $postTypeClass;
            $postType->unregister();
        }
    }

    /**
     * Register taxonomies
     */
    public function registerTaxonomies()
    {
        foreach (self::TAXONOMY_CLASSES as $taxonomyClass) {
            $taxonomy = new $taxonomyClass;
            $taxonomy->register();
        }
    }

    /**
     * Unregister taxonomies
     */
    private function unregisterTaxonomies()
    {
        foreach (self::TAXONOMY_CLASSES as $taxonomyClass) {
            $taxonomy = new $taxonomyClass;
            $taxonomy->unregister();
        }
    }

    /**
     * Add roles
     */
    private function addRoles()
    {
        foreach (self::ROLE_CLASSES as $roleClass) {
            $role = new $roleClass;
            $role->add();
        }
    }

    /**
     * Remove roles
     */
    private function removeRoles()
    {
        foreach (self::ROLE_CLASSES as $roleClass) {
            $role = new $roleClass;
            $role->remove();
        }
    }

    /**
     * Add capabilities
     */
    private function addCapabilities()
    {
        $classes = array_merge(
            self::POST_TYPE_CLASSES,
            self::TAXONOMY_CLASSES
        );

        foreach ($classes as $class) {
            $instance = new $class;
            $instance->setPermissions();
        }
    }

    /**
     * Remove capabilities
     */
    private function removeCapabilities()
    {
        $classes = array_merge(
            self::POST_TYPE_CLASSES,
            self::TAXONOMY_CLASSES
        );

        foreach ($classes as $class) {
            $instance = new $class;
            $instance->removePermissions();
        }
    }

    private function registerPluginHooks()
    {
        register_activation_hook(
            OPROFILE_PLUGIN_FILE,
            [
                $this,
                'activate'
            ]
        );

        register_deactivation_hook(
            OPROFILE_PLUGIN_FILE,
            [
                $this,
                'deactivate'
            ]
        );

        register_uninstall_hook(
            OPROFILE_PLUGIN_FILE,
            [
                self::class,
                'uninstall'
            ]
        );
    }

    public function activate()
    {
        $this->registerPostTypes();
        $this->registerTaxonomies();

        $this->router->addRewriteRules();

        flush_rewrite_rules();

        $this->addRoles();
        $this->addCapabilities();

        $this->createCustomDatabaseTables();
    }

    public function deactivate()
    {
        $this->unregisterPostTypes();
        $this->unregisterTaxonomies();

        flush_rewrite_rules();

        $this->removeCapabilities();
        $this->removeRoles();
    }

    public static function uninstall()
    {
    }

    /**
     * Create custom database tables
     */
    private function createCustomDatabaseTables()
    {
        $developerTechnologyModel = new ModelDeveloperTechnology();
        $developerTechnologyModel->createTable();
    }
}
