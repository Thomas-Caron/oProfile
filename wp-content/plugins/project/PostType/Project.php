<?php

namespace oProfile\Plugin\Project\PostType;

use oProfile\Plugin\Client\Role\Client as RoleClient;
use oProfile\Plugin\Developer\Role\Developer as RoleDeveloper;

class Project
{
    /**
     * Post type name
     *
     * @var string
     */
    public const NAME = 'project';

    /**
     * Post type roles capabilities
     *
     * @var array
     */
    private const ROLES_CAPABILITIES = [
        'administrator' => [
            'edit_project',
            'read_project',
            'delete_project',
            'edit_projects',
            'edit_others_projects',
            'publish_projects',
            'read_private_projects'
        ],
        RoleClient::NAME => [
            'edit_project',
            'read_project',
            'publish_projects'
        ],
        RoleDeveloper::NAME => [
            'edit_project',
            'read_project',
            'publish_projects'
        ]
    ];

    /**
     * Register post type
     */
    public function register()
    {
        register_post_type(
            self::NAME,
            [
                'label'           => __('Projets'),
                'public'          => true,
                'hierarchical'    => false,
                'has_archive'     => false,
                'show_in_rest'    => true,
                'capability_type' => ['project', 'projects'],
            ]
        );
    }

    /**
     * Unregister post type
     */
    public function unregister()
    {
        unregister_post_type(self::NAME);
    }

    /**
     * Set roles' post type's capabilities
     */
    public function setPermissions()
    {
        if (defined('self::ROLES_CAPABILITIES')) {
            foreach (self::ROLES_CAPABILITIES as $roleName => $capabilities) {
                $role = get_role($roleName);

                if ($role) {
                    foreach ($capabilities as $capability) {
                        $role->add_cap($capability);
                    }
                }
            }
        }
    }

    /**
     * Remove roles post type permissions
     */
    public function removePermissions()
    {
        if (defined('self::ROLES_CAPABILITIES')) {
            foreach (self::ROLES_CAPABILITIES as $roleName => $capabilities) {
                $role = get_role($roleName);

                if ($role) {
                    foreach ($capabilities as $capability) {
                        $role->remove_cap($capability);
                    }
                }
            }
        }
    }
}
