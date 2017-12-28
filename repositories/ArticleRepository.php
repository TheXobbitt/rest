<?php
/**
 * Created by PhpStorm.
 * User: xobbitt
 * Date: 12/27/17
 * Time: 11:31
 */

namespace rest\repositories;

use Exception;
use rest\models\Article;
use rest\sqlite\Connection;
use SQLite3Stmt;

/**
 * Class ArticleRepository
 * @package rest\repositories
 */
class ArticleRepository
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var string
     */
    private $tableName = 'article';

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
    private function getDb()
    {
        return $this->connection->getPdo();
    }

    /**
     * @param int $id
     * @return Article
     */
    public function findOne(int $id)
    {
        $raw = $this->getDb()->query(sprintf('SELECT * FROM %s WHERE id=%d', $this->tableName, $id))->fetchArray(SQLITE3_ASSOC);

        return Article::populate($raw);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $result = $this->getDb()->query(sprintf('SELECT * FROM %s', $this->tableName));
        $articles = [];
        while ($raw = $result->fetchArray(SQLITE3_ASSOC)) {
            if (!isset($raw['id'])) {
                continue;
            }

            $articles[] = Article::populate($raw);
        }

        return $articles;
    }

    /**
     * @param Article $article
     * @throws Exception
     */
    public function insert(Article $article)
    {
        $sql = sprintf('INSERT INTO %s (id, title, description, body) '
            . 'VALUES (:id, :title, :description, :body)', $this->tableName);

        $stmt = $this->prepareSql($article, $sql);
        if (!$stmt->execute()) {
            throw new Exception('New article does not inserted.');
        }
    }

    /**
     * @param Article $article
     * @throws Exception
     */
    public function update(Article $article)
    {
        $sql = sprintf('UPDATE %s '
            . 'SET title = :title, '
            . 'description = :description, '
            . 'body = :body '
            . 'WHERE id = :id', $this->tableName);

        $stmt = $this->prepareSql($article, $sql);
        if (!$stmt->execute()) {
            throw new Exception('New article does not updated.');
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $sql = sprintf('DELETE FROM %s WHERE id = %d', $this->tableName, $id);

        return $this->getDb()->exec($sql);
    }

    /**
     * @param Article $article
     * @param string $sql
     * @return SQLite3Stmt
     */
    private function prepareSql(Article $article, $sql)
    {
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':id', $article->getId(), SQLITE3_INTEGER);
        $stmt->bindValue(':title', $article->getTitle(), SQLITE3_TEXT);
        $stmt->bindValue(':description', $article->getDescription(), SQLITE3_TEXT);
        $stmt->bindValue(':body', $article->getBody(), SQLITE3_TEXT);

        return $stmt;
    }
}
