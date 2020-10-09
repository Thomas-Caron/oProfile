<?php

namespace oProfile\Taxonomy;

abstract class CoreTaxonomy
{
    /**
     * Register taxonomy
     */
    abstract public function register();

    /**
     * Unregister taxonomy
     */
    public function unregister()
    {
        unregister_taxonomy(static::NAME);
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
