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

class ArticleService
{
    private $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $articleData
     * @return Article
     * @throws \Exception
     */
    public function create($articleData): Article
    {
        $article = Article::create(
            $articleData['id'] ?? '',
            $articleData['title'] ?? '',
            $articleData['description'] ?? '',
            $articleData['body'] ?? ''
        );

        $this->repository->insert($article);

        return $article;
    }

    /**
     * @param integer $articleId
     * @param array $articleData
     * @return Article
     * @throws \Exception
     */
    public function update(int $articleId, array $articleData): Article
    {
        $article = $this->repository->findOne($articleId);
        if (isset($articleData['id'])) {
            unset($articleData['id']);
        }

        $article = $article->updateFields($articleData);
        $this->repository->update($article);

        return $article;
    }
}
