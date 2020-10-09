<?php

namespace oProfile\Role;

class CoreRole
{
    /**
     * Add role
     */
    public function add()
    {
        add_role(
            static::NAME,
            __(static::DISPLAY_NAME)
        );
    }

    /**
     * Remove role
     */
    public function remove()
    {
        remove_role(static::NAME);
    }
}
