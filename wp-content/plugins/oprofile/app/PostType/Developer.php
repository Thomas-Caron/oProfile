<?php

namespace oProfile\PostType;

use oProfile\Role\Developer as RoleDeveloper;

class Developer extends CorePostType
{
    /**
     * Post type name
     *
     * @var string
     */
    public const NAME = 'developer';

    /**
     * Roles' capabilities
     */
    protected const ROLES_CAPABILITIES = [
        'administrator' => [
            'edit_developer',
            'read_developer',
            'delete_developer',
            'edit_developers',
            'edit_others_developers',
            'publish_developers',
            'read_private_developers'
        ],
        RoleDeveloper::NAME => [
            'edit_developer',
            'read_developer',
            'publish_developers'
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
                'label'           => __('Développeurs'),
                'public'          => true,
                'hierarchical'    => false,
                'show_in_rest'    => true,
                /**
                 * @link https://developer.wordpress.org/reference/functions/register_post_type/#capability_type
                 */
                'capability_type' => ['developer', 'developers'],
                'has_archive'     => true
            ]
        );
    }
}
