<?php

namespace oProfile\Taxonomy;

use oProfile\PostType\Developer as PostTypeDeveloper;
use oProfile\PostType\Project as PostTypeProject;

class Technology extends CoreTaxonomy
{
    /**
     * Taxonomy name
     *
     * @var string
     */
    public const NAME = 'technology';

    /**
     * Roles' capabilities
     *
     * @var array
     */
    protected const ROLES_CAPABILITIES = [
        'administrator' => [
            'manage_technologies',
            'edit_technologies',
            'delete_technologies'
        ]
    ];

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
}
