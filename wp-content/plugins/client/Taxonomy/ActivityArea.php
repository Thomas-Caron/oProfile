<?php

namespace oProfile\Plugin\Client\Taxonomy;

use oProfile\Plugin\Client\PostType\Client as PostTypeClient;

class ActivityArea
{
    /**
     * Taxonomy name
     *
     * @var string
     */
    public const NAME = 'activity_area';

    /**
     * Roles taxonomy capabilities
     *
     * @var array
     */
    private const ROLES_CAPABILITIES = [
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

    /**
     * Unregister taxonomy
     */
    public function unregister()
    {
        unregister_taxonomy(self::NAME);
    }

    /**
     * Set permissions
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
     * Removes permissions
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
