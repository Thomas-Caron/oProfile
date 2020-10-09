<?php

namespace oProfile\Plugin\Developer;

// Grâce aux alias définis avec as, je renomme ma classe juste pour ce fichier

use oProfile\Plugin\Developer\Model\DeveloperTechnology as ModelDeveloperTechnology;
use oProfile\Plugin\Developer\PostType\Developer as PostTypeDeveloper;
use oProfile\Plugin\Developer\Taxonomy\Skill as TaxonomySkill;
use oProfile\Plugin\Developer\Taxonomy\Technology as TaxonomyTechnology;

use oProfile\Plugin\Developer\Role\Developer as RoleDeveloper;

class Plugin
{
    /**
     * Initialize the plugin
     */
    public function run()
    {
        $this->registerPluginHooks();

        $this->addInitActions();

        $this->addRegistrationRolesFilter();
    }

    /**
     * Add init actions
     */
    public function addInitActions()
    {
        add_action(
            'init',
            [
                $this,
                'registerPostTypes'
            ]
        );

        add_action(
            'init',
            [
                $this,
                'registerTaxonomies'
            ]
        );
    }

    /**
     * Register post types
     */
    public function registerPostTypes()
    {
        $developerPostType = new PostTypeDeveloper;
        $developerPostType->register();
    }

    /**
     * Unregister post types
     */
    public function unregisterPostTypes()
    {
        $developerPostType = new PostTypeDeveloper;
        $developerPostType->unregister();
    }

    /**
     * Register taxonomies
     */
    public function registerTaxonomies()
    {
        $skillTaxonomy = new TaxonomySkill;
        $skillTaxonomy->register();

        $technologyTaxonomy = new TaxonomyTechnology;
        $technologyTaxonomy->register();
    }

    /**
     * Unregister taxonomies
     */
    public function unregisterTaxonomies()
    {
        $skillTaxonomy = new TaxonomySkill;
        $skillTaxonomy->unregister();

        $technologyTaxonomy = new TaxonomyTechnology;
        $technologyTaxonomy->unregister();
    }

    /**
     * Add roles
     */
    public function addRoles()
    {
        $developerRole = new RoleDeveloper;
        $developerRole->add();
    }

    /**
     * Remove roles
     */
    public function removeRoles()
    {
        $developerRole = new RoleDeveloper;
        $developerRole->remove();
    }

    /**
     * Add capabilities
     */
    public function addCapabilities()
    {
        $developerPostType = new PostTypeDeveloper;
        $developerPostType->setPermissions();

        $skillTaxonomy = new TaxonomySkill;
        $skillTaxonomy->setPermissions();

        $technologyTaxonomy = new TaxonomyTechnology;
        $technologyTaxonomy->setPermissions();
    }

    /**
     * Remove capabilities
     */
    public function removeCapabilities()
    {
        $developerPostType = new PostTypeDeveloper;
        $developerPostType->removePermissions();

        $skillTaxonomy = new TaxonomySkill;
        $skillTaxonomy->removePermissions();

        $technologyTaxonomy = new TaxonomyTechnology;
        $technologyTaxonomy->removePermissions();
    }

    /**
     * Register activation and deactivation hooks
     */
    public function registerPluginHooks()
    {
        register_activation_hook(
            OPROFILE_DEVELOPER_PLUGIN_FILE,
            [
                $this,
                'activate'
            ]
        );

        register_deactivation_hook(
            OPROFILE_DEVELOPER_PLUGIN_FILE,
            [
                $this,
                'deactivate'
            ]
        );

        register_uninstall_hook(
            OPROFILE_DEVELOPER_PLUGIN_FILE,
            [
                self::class,
                'uninstall'
            ]
        );
    }

    /**
     * Activate plugin
     */
    public function activate()
    {
        $this->registerPostTypes();
        $this->registerTaxonomies();

        flush_rewrite_rules();

        $this->addRoles();
        $this->addCapabilities();

        $this->createCustomDatabaseTables();
    }

    /**
     * Deactivate plugin
     */
    public function deactivate()
    {
        $this->unregisterPostTypes();
        $this->unregisterTaxonomies();

        flush_rewrite_rules();

        $this->removeRoles();
        $this->removeCapabilities();
    }

    public static function uninstall()
    {
        // Ne pas forcément supprimer les tables à la désinstallation
        $developerTechnologyModel = new ModelDeveloperTechnology;
        $developerTechnologyModel->dropTable();
    }

    /**
     * Add oprofile_registration_roles
     */
    private function addRegistrationRolesFilter()
    {
        add_filter(
            'oprofile_registration_roles',
            [
                $this,
                'addRegistrationRole'
            ]
        );
    }

    /**
     * Add registration form role
     *
     * @param array $roles Role list
     *
     * @return array Updated role list
     */
    public function addRegistrationRole($roles)
    {
        $roles[RoleDeveloper::NAME] = RoleDeveloper::DISPLAY_NAME;

        return $roles;
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
