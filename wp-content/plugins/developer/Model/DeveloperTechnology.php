<?php

namespace oProfile\Plugin\Developer\Model;

class DeveloperTechnology extends CoreModel
{
    /**
     * Table name
     *
     * @var string
     */
    protected const TABLE_NAME = 'developer_technology_relationships';

    /**
     * Level list
     *
     * @var array
     */
    private const LEVEL = [
        1 => 'Débutant',
        2 => 'Confirmé',
        3 => 'Expert'
    ];

    /**
     * Create database table
     */
    public function createTable()
    {
        $charset_collate = $this->connector->get_charset_collate();

        $sql = "
            CREATE TABLE IF NOT EXISTS `{$this->getTableName()}` (
                `developer_id` BIGINT(20) UNSIGNED NOT NULL,
                `technology_id` BIGINT(20) UNSIGNED NOT NULL,
                `level` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
                PRIMARY KEY(`developer_id`, `technology_id`)
            ) {$charset_collate};
        ";

        $this->connector->query($sql);
    }

    /**
     * Drop database table
     */
    public function dropTable()
    {
        $sql = "DROP TABLE IF EXISTS `{$this->getTableName()}`;";

        $this->connector->query($sql);
    }

    /**
     * Get developer techonology list
     *
     * @param int $developerId Developer id
     *
     * @return array
     */
    public function getTechnologies($developerId)
    {
        $sql = "
            SELECT
                `technology_id`,
                `level`
            FROM `{$this->getTableName()}`
            WHERE `developer_id` = %d
        ";

        $results = $this->connector->get_results(
            $this->connector->prepare(
                $sql,
                $developerId
            ),
            ARRAY_A
        );

        $technologies = [];

        foreach ($results as $result) {
            $technology = get_term($result['technology_id']);

            $technologies[] = [
                'level' => $result['level'],
                'term'  => $technology
            ];
        }

        return $technologies;
    }

    public function getDevelopers($technologyId)
    {
    }

    /**
     * Insert a row
     *
     * @param int $developerId  Developer id
     * @param int $technologyId Technology id
     * @param int $level        Level
     */
    public function insert($developerId, $technologyId, $level)
    {
        $sql = "
            INSERT INTO `{$this->getTableName()}` (`developer_id`, `technology_id`, `level`)
            VALUES(%d, %d, %d);
        ";

        $this->connector->query(
            $this->connector->prepare(
                $sql,
                $developerId,
                $technologyId,
                $level
            )
        );
    }

    /**
     * Update a row
     *
     * @param int $developerId  Developer id
     * @param int $technologyId Technology id
     * @param int $level        Level
     */
    public function update($developerId, $technologyId, $level)
    {
        $sql = "
            UPDATE `{$this->getTableName()}`
            SET
                `level` = %d
            WHERE
                `developer_id` = %d
                AND `technology_id` = %d;
        ";

        $this->connector->query(
            $this->connector->prepare(
                $sql,
                $level,
                $developerId,
                $technologyId
            )
        );
    }

    /**
     * Delete a row
     *
     * @param int $developerId  Developer id
     * @param int $technologyId Technology id
     */
    public function delete($developerId, $technologyId)
    {
        $sql = "
            DELETE FROM `{$this->getTableName()}`
            WHERE
                `developer_id` = %d
                AND `technology_id` = %d;
        ";

        $this->connector->query(
            $this->connector->prepare(
                $sql,
                $developerId,
                $technologyId
            )
        );
    }

    /**
     * Delete rows by developer_id
     *
     * @param int $developerId  Developer id
     */
    public function deleteDeveloperTechnologies($developerId)
    {
        $sql = "
            DELETE FROM `{$this->getTableName()}`
            WHERE `developer_id` = %d;
        ";

        $this->connector->query(
            $this->connector->prepare(
                $sql,
                $developerId
            )
        );
    }

    /**
     * Get level name
     *
     * @param int $levelId Level id
     *
     * @return string Level name
     */
    public static function getLevelName($levelId) {
        $levelName = '';

        if (array_key_exists($levelId, self::LEVEL)) {
            $levelName = self::LEVEL[$levelId];
        }

        return $levelName;
    }
}
