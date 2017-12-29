<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 02:26
 */

namespace auth\repositories;

use auth\models\User;
use base\exceptions\DomainException;
use base\repositories\Repository;
use Exception;

/**
 * Class UserRepository
 * @package auth\repositories
 */
class UserRepository extends Repository
{
    /**
     * @var string
     */
    protected $tableName = 'user';

    /**
     * @param string $username
     * @return User|null
     */
    public function findOne(string $username)
    {
        try {
            $raw = $this->getDb()
                ->query(sprintf('SELECT * FROM %s WHERE username="%s"', $this->tableName, $username))
                ->fetchArray(SQLITE3_ASSOC);
        } catch (Exception $exception) {
            throw new DomainException('User was not found');
        }

        return is_array($raw) ? User::populate($raw) : null;
    }
}
