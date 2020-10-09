<?php

namespace oProfile\Plugin\Developer\PostType;

use oProfile\Plugin\Developer\Role\Developer as RoleDeveloper;

class Developer
{
    /**
     * Post type name
     *
     * @var string
     */
    public const NAME = 'developer';

    /**
     * Register post type
     */
    public function register()
    {
        register_post_type(
            self::NAME,
            [
                'label'           => __('Développeur'),
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

    /**
     * Unregister post type
     */
    public function unregister()
    {
        unregister_post_type(self::NAME);
    }

    /**
     * Set roles capabilities
     */
    public function setPermissions()
    {
        /**
         * Adminstrator role
         *
         * @var \WP_Role
         */
        $administratorRole = get_role('administrator');

        $administratorRole->add_cap('edit_developer');
        $administratorRole->add_cap('read_developer');
        $administratorRole->add_cap('delete_developer');
        $administratorRole->add_cap('edit_developers');
        $administratorRole->add_cap('edit_others_developers');
        $administratorRole->add_cap('publish_developers');
        $administratorRole->add_cap('read_private_developers');


        $developerRole  = get_role(RoleDeveloper::NAME);

        $developerRole->add_cap('edit_developer');
        $developerRole->add_cap('read_developer');
        $developerRole->add_cap('publish_developers');
    }

    /**
     * Remove roles capabilities
     */
    public function removePermissions()
    {
        $administratorRole = get_role('administrator');

        $administratorRole->remove_cap('edit_developer');
        $administratorRole->remove_cap('read_developer');
        $administratorRole->remove_cap('delete_developer');$administratorRole->remove_cap('edit_developers');$administratorRole->remove_cap('edit_others_developers');$administratorRole->remove_cap('publish_developers');
        $administratorRole->remove_cap('read_private_developers');


        // Même si le rôle (du user) est supprimé et donc ses capacités, je fais quand même la suppression au cas où j'ai besoin de supprimer les capacités sans supprimer le rôle
        $developerRole = get_role(RoleDeveloper::NAME);

        if ($developerRole) {
            $developerRole->remove_cap('edit_developer');
            $developerRole->remove_cap('read_developer');
            $developerRole->remove_cap('publish_developers');
        }
    }
}
