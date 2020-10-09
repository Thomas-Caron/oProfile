<?php

namespace oProfile\Plugin\Developer\Taxonomy;

use oProfile\Plugin\Developer\PostType\Developer as PostTypeDeveloper;

class Skill
{
    /**
     * Taxonomy name
     *
     * @var string
     */
    public const NAME = 'skill';

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

        $administratorRole->add_cap('manage_skills');
        $administratorRole->add_cap('edit_skills');
        $administratorRole->add_cap('delete_skills');
    }

    /**
     * Remove roles capabilities
     */
    public function removePermissions()
    {
        $administratorRole = get_role('administrator');

        $administratorRole->remove_cap('manage_skills');
        $administratorRole->remove_cap('edit_skills');
        $administratorRole->remove_cap('delete_skills');
    }
}
