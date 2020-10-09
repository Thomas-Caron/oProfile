<?php

namespace oProfile\Plugin\Client\Role;

class Client
{
    /**
     * Role name
     *
     * @var string
     */
    public const NAME = 'client';

    /**
     * Display name
     *
     * @var string
     */
    public const DISPLAY_NAME = 'Client';

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
