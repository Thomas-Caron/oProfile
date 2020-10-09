<?php

namespace oProfile\Plugin\Developer\Role;

class Developer
{
    /**
     * Role name
     *
     * @var string
     */
    public const NAME = 'developer';

    /**
     * Display name
     *
     * @var string
     */
    public const DISPLAY_NAME = 'Développeur';

    /**
     * Add role
     */
    public function add()
    {
        add_role(
            self::NAME,
            __(self::DISPLAY_NAME)
        );
    }

    /**
     * Remove role
     */
    public function remove()
    {
        remove_role(self::NAME);
    }
}
