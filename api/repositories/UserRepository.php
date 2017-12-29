<?php
/**
 * Created by PhpStorm.
 * User: xobbitt
 * Date: 12/29/17
 * Time: 04:01
 */

namespace rest\repositories;

use base\exceptions\DomainException;
use base\repositories\Repository;
use Exception;
use rest\models\User;

/**
 * Class UserRepository
 * @package rest\repositories
 */
class UserRepository extends Repository
{
    /**
     * @var string
     */
    protected $tableName = 'user';

    /**
     * @param User $user
     */
    public function insert(User $user)
    {
        $sql = sprintf('INSERT INTO %s (username, token) '
            . 'VALUES (:username, :token)', $this->tableName);

        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername(), SQLITE3_TEXT);
        $stmt->bindValue(':token', $user->getToken(), SQLITE3_TEXT);
        try {
            $stmt->execute();
        } catch (Exception $exception) {
            throw new DomainException('New user was not inserted.');
        }
    }

    /**
     * @param User $user
     */
    public function update(User $user)
    {
        $sql = sprintf('UPDATE %s '
            . 'SET username = :username, '
            . 'token = :token '
            . 'WHERE id = :id', $this->tableName);

        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':id', $user->getId(), SQLITE3_INTEGER);
        $stmt->bindValue(':username', $user->getUsername(), SQLITE3_TEXT);
        $stmt->bindValue(':token', $user->getToken(), SQLITE3_TEXT);
        try {
            $stmt->execute();
        } catch (Exception $exception) {
            throw new DomainException('User was not updated.');
        }
    }

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
