<?php

namespace oProfile\PostType;

use oProfile\Role\Client as RoleClient;

class Client extends CorePostType
{
    /**
     * Post type name
     *
     * @var string
     */
    public const NAME = 'client';

    /**
     * Post type roles capabilities
     *
     * @var array
     */
    protected const ROLES_CAPABILITIES = [
        'administrator' => [
            'edit_client',
            'read_client',
            'delete_client',
            'edit_clients',
            'edit_others_clients',
            'publish_clients',
            'read_private_clients'
        ],
        RoleClient::NAME => [
            'edit_client',
            'read_client',
            'publish_clients'
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
                'label'           => __('Clients'),
                'public'          => true,
                'hierarchical'    => false,
                'show_in_rest'    => true,
                'capability_type' => ['client', 'clients'],
                'has_archive'     => true
            ]
        );
    }
}
