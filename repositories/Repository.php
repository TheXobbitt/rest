<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/28/17
 * Time: 20:53
 */

namespace rest\repositories;

use rest\sqlite\Connection;

/**
 * Class Repository
 * @package rest\repositories
 */
abstract class Repository
{
    /**
     * @var Connection
     */
    protected $connection;
    /**
     * @var string
     */
    protected $tableName;

    /**
     * ArticleRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return \SQLite3
     */
    protected function getDb()
    {
        return $this->connection->getPdo();
    }

    /**
     * @return integer
     */
    public function getLastInsertedId()
    {
        return $this->getDb()->lastInsertRowID();
    }
}
