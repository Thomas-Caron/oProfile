<?php

namespace oProfile\PostType;

use oProfile\Role\Client as RoleClient;
use oProfile\Role\Developer as RoleDeveloper;

class Project extends CorePostType
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
    protected const ROLES_CAPABILITIES = [
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
}
