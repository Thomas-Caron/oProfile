<?php

namespace oProfile\Plugin\Client;

use oProfile\Plugin\Client\PostType\Client as PostTypeClient;

use oProfile\Plugin\Client\Taxonomy\ActivityArea as TaxonomyActivityArea;

use oProfile\Plugin\Client\Role\Client as RoleClient;

class Plugin
{
    public function run()
    {
        $this->registerPluginHooks();

        $this->addInitActions();

        $this->addRegistrationRolesFilter();
    }

    private function addInitActions()
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
        $clientPostType = new PostTypeClient;
        $clientPostType->register();
    }

    /**
     * Unregister post types
     */
    public function unregisterPostTypes()
    {
        $clientPostType = new PostTypeClient;
        $clientPostType->unregister();
    }

    /**
     * Register taxonomies
     */
    public function registerTaxonomies()
    {
        $activityAreaTaxonomy = new TaxonomyActivityArea;
        $activityAreaTaxonomy->register();
    }

    /**
     * Unregister taxonomies
     */
    public function unregisterTaxonomies()
    {
        $activityAreaTaxonomy = new TaxonomyActivityArea;
        $activityAreaTaxonomy->unregister();
    }

    /**
     * Add roles
     */
    private function addRoles()
    {
        $clientRole = new RoleClient;
        $clientRole->add();
    }

    /**
     * Remove roles
     */
    private function removeRoles()
    {
        $clientRole = new RoleClient;
        $clientRole->remove();
    }

    /**
     * Add capabilities
     */
    private function addCapabilities()
    {
        $clientPostType = new PostTypeClient;
        $clientPostType->setPermissions();

        $activityAreaTaxonomy = new TaxonomyActivityArea;
        $activityAreaTaxonomy->setPermissions();
    }

    /**
     * Add capabilities
     */
    private function removeCapabilities()
    {
        $clientPostType = new PostTypeClient;
        $clientPostType->removePermissions();

        $activityAreaTaxonomy = new TaxonomyActivityArea;
        $activityAreaTaxonomy->removePermissions();
    }

    /**
     * Register activation and deactivation hooks
     */
    private function registerPluginHooks()
    {
        register_activation_hook(
            OPROFILE_PLUGIN_CLIENT_FILE,
            [
                $this,
                'activate'
            ]
        );

        register_deactivation_hook(
            OPROFILE_PLUGIN_CLIENT_FILE,
            [
                $this,
                'deactivate'
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
    }

    /**
     * Deactivate plugin
     */
    public function deactivate()
    {
        $this->unregisterPostTypes();
        $this->unregisterTaxonomies();

        flush_rewrite_rules();

        $this->removeCapabilities();
        $this->removeRoles();
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
        $roles[RoleClient::NAME] = RoleClient::DISPLAY_NAME;

        return $roles;
    }
}
