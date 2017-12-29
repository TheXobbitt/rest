<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 03:01
 */

namespace auth\repositories;

use auth\models\Client;
use base\exceptions\DomainException;
use base\repositories\Repository;
use Exception;

/**
 * Class ClientRepository
 * @package auth\repositories
 */
class ClientRepository extends Repository
{
    /**
     * @var string
     */
    protected $tableName = 'client';

    /**
     * @param int $id
     * @return Client|null
     */
    public function findOne(int $id)
    {
        try {
            $raw = $this->getDb()
                ->query(sprintf('SELECT * FROM %s WHERE id=%d', $this->tableName, $id))
                ->fetchArray(SQLITE3_ASSOC);
        } catch (Exception $exception) {
            throw new DomainException('Client was not found');
        }

        return is_array($raw) ? Client::populate($raw) : null;
    }
}
