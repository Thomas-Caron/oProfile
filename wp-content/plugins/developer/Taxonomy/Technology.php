<?php

namespace oProfile\Plugin\Developer\Taxonomy;

use oProfile\Plugin\Developer\PostType\Developer as PostTypeDeveloper;
use oProfile\Plugin\Project\PostType\Project as PostTypeProject;

class Technology
{
    /**
     * Taxonomy name
     *
     * @var string
     */
    public const NAME = 'technology';

    /**
     * Register taxonomy
     */
    public function register()
    {
        register_taxonomy(
            self::NAME,
            [
                PostTypeDeveloper::NAME,
                PostTypeProject::NAME
            ],
            [
                'label'        => __('Technologie'),
                'public'       => true,
                'hierarchical' => false,
                'show_in_rest' => true,
                'capabilities' => [
                    'manage_terms' => 'manage_technologies',
                    'edit_terms'   => 'edit_technologies',
                    'delete_terms' => 'delete_technologies',
                    'assign_terms' => 'edit_developer' // à vérifier
                ]
            ]
        );
    }

    /**
     * Unregister taxonomy
     */
    public function unregister()
    {
        unregister_taxonomy(self::NAME);
    }

    /**
     * Add roles capabilities
     */
    public function setPermissions()
    {
        $administratorRole = get_role('administrator');

        $administratorRole->add_cap('manage_technologies');
        $administratorRole->add_cap('edit_technologies');
        $administratorRole->add_cap('delete_technologies');
    }

    /**
     * Remove roles capabilities
     */
    public function removePermissions()
    {
        $administratorRole = get_role('administrator');

        $administratorRole->remove_cap('manage_technologies');
        $administratorRole->remove_cap('edit_technologies');
        $administratorRole->remove_cap('delete_technologies');
    }
}
