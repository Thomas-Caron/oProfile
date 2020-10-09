<?php

namespace oProfile\PostType;

abstract class CorePostType
{
    /**
     * Register post type
     */
    abstract public function register();

    /**
     * Unregister post type
     */
    public function unregister()
    {
        unregister_post_type(static::NAME);
    }

    /**
     * Set roles' capabilities
     */
    public function setPermissions()
    {
        if (defined('static::ROLES_CAPABILITIES')) {
            $rolesCapabilities = static::ROLES_CAPABILITIES;

            foreach ($rolesCapabilities as $roleName => $capabilities) {
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
     * Remove roles' capabilities
     */
    public function removePermissions()
    {
        if (defined('static::ROLES_CAPABILITIES')) {
            $rolesCapabilities = static::ROLES_CAPABILITIES;

            foreach ($rolesCapabilities as $roleName => $capabilities) {
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
