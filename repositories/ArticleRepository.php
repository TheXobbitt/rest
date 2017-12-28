<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 11:31
 */

namespace rest\repositories;

use Exception;
use rest\exceptions\DomainException;
use rest\models\Article;
use SQLite3Stmt;

/**
 * Class ArticleRepository
 * @package rest\repositories
 */
class ArticleRepository extends Repository
{
    /**
     * @var string
     */
    protected $tableName = 'article';

    /**
     * @param Article $article
     * @throws Exception
     */
    public function insert(Article $article)
    {
        $sql = sprintf('INSERT INTO %s (title, description, body) '
            . 'VALUES (:title, :description, :body)', $this->tableName);

        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':title', $article->getTitle(), SQLITE3_TEXT);
        $stmt->bindValue(':description', $article->getDescription(), SQLITE3_TEXT);
        $stmt->bindValue(':body', $article->getBody(), SQLITE3_TEXT);
        try {
            $stmt->execute();
        } catch (Exception $exception) {
            throw new DomainException('New article was not inserted.');
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

        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':id', $article->getId(), SQLITE3_INTEGER);
        $stmt->bindValue(':title', $article->getTitle(), SQLITE3_TEXT);
        $stmt->bindValue(':description', $article->getDescription(), SQLITE3_TEXT);
        $stmt->bindValue(':body', $article->getBody(), SQLITE3_TEXT);
        try {
            $stmt->execute();
        } catch (Exception $exception) {
            throw new DomainException('Article was not updated.');
        }
    }

    /**
     * @param Article $article
     * @return bool
     */
    public function delete(Article $article)
    {
        $sql = sprintf('DELETE FROM %s WHERE id = %d', $this->tableName, $article->getId());

        try {
            $this->getDb()->exec($sql);

            return true;
        } catch (Exception $exception) {
            throw new DomainException('Article was not deleted.');
        }
    }

    /**
     * @param int $id
     * @return Article
     */
    public function findOne(int $id)
    {
        try {
            $raw = $this->getDb()->query(sprintf('SELECT * FROM %s WHERE id=%d', $this->tableName, $id))->fetchArray(SQLITE3_ASSOC);
        } catch (Exception $exception) {
            throw new DomainException('Article was not found');
        }

        return is_array($raw) ? Article::populate($raw) : null;
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
}
