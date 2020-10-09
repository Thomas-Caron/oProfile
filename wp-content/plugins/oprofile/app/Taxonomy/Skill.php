<?php

namespace oProfile\Taxonomy;

use oProfile\PostType\Developer as PostTypeDeveloper;

class Skill extends CoreTaxonomy
{
    /**
     * Taxonomy name
     *
     * @var string
     */
    public const NAME = 'skill';

    /**
     * Roles' capabilities
     *
     * @var array
     */
    protected const ROLES_CAPABILITIES = [
        'administrator' => [
            'manage_skills',
            'edit_skills',
            'delete_skills',
        ]
    ];

    /**
     * Register taxonomy
     */
    public function register()
    {
        register_taxonomy(
            self::NAME,
            PostTypeDeveloper::NAME,
            [
                'label'        => __('Compétence'),
                'public'       => true,
                'hierarchical' => false,
                'show_in_rest' => true,
                'capabilities' => [
                    'manage_terms' => 'manage_skills',
                    'edit_terms'   => 'edit_skills',
                    'delete_terms' => 'delete_skills',
                    'assign_terms' => 'edit_developer' // à vérifier
                ]
            ]
        );
    }
}
