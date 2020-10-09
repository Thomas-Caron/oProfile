<?php

namespace oProfile\Plugin\Project;

use oProfile\Plugin\Project\PostType\Project as PostTypeProject;

class Plugin
{
    /**
     * Start plugin treatments
     */
    public function run()
    {
        $this->registerPluginHooks();

        $this->addInitActions();
    }

    /**
     * Add init hook actions
     */
    private function addInitActions()
    {
        add_action(
            'init',
            [
                $this,
                'registerPostTypes'
            ]
        );
    }

    /**
     * Register post types
     */
    public function registerPostTypes()
    {
        $projectPostType = new PostTypeProject;
        $projectPostType->register();
    }

    /**
     * Unregister post types
     */
    public function unregisterPostTypes()
    {
        $projectPostType = new PostTypeProject;
        $projectPostType->unregister();
    }

    /**
     * Add roles capabilities
     */
    public function addCapabilities()
    {
        $projectPostType = new PostTypeProject;
        $projectPostType->setPermissions();
    }

    /**
     * Remove roles capabilities
     */
    public function removeCapabilities()
    {
        $projectPostType = new PostTypeProject;
        $projectPostType->removePermissions();
    }

    /**
     * Register activation, deactivation and uninstall hooks
     */
    private function registerPluginHooks()
    {
        register_activation_hook(
            OPROFILE_PLUGIN_PROJECT_FILE,
            [
                $this,
                'activate'
            ]
        );

        register_deactivation_hook(
            OPROFILE_PLUGIN_PROJECT_FILE,
            [
                $this,
                'deactivate'
            ]
        );
    }

    /**
     * Activation tasks
     */
    public function activate()
    {
        $this->registerPostTypes();

        flush_rewrite_rules();

        $this->addCapabilities();
    }

    /**
     * Deactivation tasks
     */
    public function deactivate()
    {
        $this->unregisterPostTypes();

        flush_rewrite_rules();

        $this->removeCapabilities();
    }
}
