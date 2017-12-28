<?php
/**
 * Created by PhpStorm.
 * User: xobbitt
 * Date: 12/27/17
 * Time: 19:26
 */

namespace rest\services;

use rest\models\Article;
use rest\repositories\ArticleRepository;

/**
 * Class ArticleService
 * @package rest\services
 */
class ArticleService
{
    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
     * ArticleService constructor.
     * @param ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $articleData
     * @return Article
     * @throws \Exception
     */
    public function create(array $articleData): Article
    {
        $article = Article::create(
            $articleData['title'] ?? '',
            $articleData['description'] ?? '',
            $articleData['body'] ?? ''
        );

        $this->repository->insert($article);
        $article->setId($this->repository->getLastInsertedId());

        return $article;
    }

    /**
     * @param Article $article
     * @param array $articleData
     * @return Article
     * @throws \Exception
     */
    public function update(Article $article, array $articleData): Article
    {
        if (isset($articleData['id'])) {
            unset($articleData['id']);
        }

        $article = $article->updateFields($articleData);
        $this->repository->update($article);

        return $article;
    }
}
