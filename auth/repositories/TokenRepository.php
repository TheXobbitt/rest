<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 02:01
 */

namespace auth\repositories;

use auth\models\Token;
use base\exceptions\DomainException;
use base\repositories\Repository;
use Exception;

/**
 * Class TokenRepository
 * @package auth\repositories
 */
class TokenRepository extends Repository
{
    /**
     * @var string
     */
    protected $tableName = 'token';

    /**
     * @param Token $token
     */
    public function insert(Token $token)
    {
        $sql = sprintf('INSERT INTO %s (token, user_id) '
            . 'VALUES (:token, :user_id)', $this->tableName);

        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':token', $token->getToken(), SQLITE3_TEXT);
        $stmt->bindValue(':user_id', $token->getUserId(), SQLITE3_INTEGER);
        try {
            $stmt->execute();
        } catch (Exception $exception) {
            throw new DomainException('New token was not inserted.');
        }
    }
}
