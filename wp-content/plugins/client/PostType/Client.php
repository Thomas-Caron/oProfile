<?php

namespace oProfile\Plugin\Client\PostType;

use oProfile\Plugin\Client\Role\Client as RoleClient;

class Client
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
    private const ROLES_CAPABILITIES = [
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
                'label'           => __('Client'),
                'public'          => true,
                'hierarchical'    => false,
                'show_in_rest'    => true,
                'capability_type' => ['client', 'clients'],
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
        $this->addCapabilities('administrator');
        $this->addCapabilities(RoleClient::NAME);
    }

    /**
     * Set role capabilities
     *
     * @param string $roleName Role name
     */
    private function addCapabilities($roleName)
    {
        $role = get_role($roleName);

        if ($role) {
            if (isset(self::ROLES_CAPABILITIES[$roleName])) {
                $roleCapabilities = self::ROLES_CAPABILITIES[$roleName];

                if (! empty($roleCapabilities)) {
                    foreach ($roleCapabilities as $capability) {
                        $role->add_cap($capability);
                    }
                }
            }
        }
    }

    /**
     * Remove roles capabities
     */
    public function removePermissions()
    {
        $this->removeCapabilities('administrator');
        $this->removeCapabilities(RoleClient::NAME);
    }

    /**
     * Remove role capabilities
     *
     * @param string $roleName Role name
     */
    private function removeCapabilities($roleName)
    {
        $role = get_role($roleName);

        if ($role) {
            if (isset(self::ROLES_CAPABILITIES[$roleName])) {
                $roleCapabilities = self::ROLES_CAPABILITIES[$roleName];

                if (! empty($roleCapabilities)) {
                    foreach ($roleCapabilities as $capability) {
                        $role->remove_cap($capability);
                    }
                }
            }
        }
    }
}
