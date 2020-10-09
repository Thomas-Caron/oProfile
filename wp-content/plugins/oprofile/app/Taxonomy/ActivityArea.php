<?php

namespace oProfile\Taxonomy;

use oProfile\PostType\Client as PostTypeClient;

class ActivityArea extends CoreTaxonomy
{
    /**
     * Taxonomy name
     *
     * @var string
     */
    public const NAME = 'activity_area';

    /**
     * Roles' capabilities
     *
     * @var array
     */
    protected const ROLES_CAPABILITIES = [
        'administrator' => [
            'manage_activity_area',
            'edit_activity_area',
            'delete_activity_area',
        ]
    ];

    /**
     * Register taxonomy
     */
    public function register()
    {
        register_taxonomy(
            self::NAME,
            PostTypeClient::NAME,
            [
                'label'           => __('Secteurs d\'activité'),
                'public'          => true,
                'hierarchical'    => true,
                'show_in_rest'    => true,
                'capabilities' => [
                    'manage_terms' => 'manage_activity_area',
                    'edit_terms'   => 'edit_activity_area',
                    'delete_terms' => 'delete_activity_area',
                    'assign_terms' => 'edit_client'
                ]
            ]
        );
    }
}
