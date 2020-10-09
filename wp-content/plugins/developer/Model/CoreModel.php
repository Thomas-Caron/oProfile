<?php

namespace oProfile\Plugin\Developer\Model;

abstract class CoreModel
{
    /**
     * Database connector
     *
     * @var \wpdb
     */
    protected $connector;

    /**
     * Constructor
     */
    public function __construct()
    {
        global $wpdb;

        $this->connector = $wpdb;
    }

    protected function getTableName()
    {
        // static = self avec héritage
        return $this->connector->prefix . static::TABLE_NAME;
    }
}
