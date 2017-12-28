<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 13:25
 */

namespace rest\controllers;

use rest\components\Request;
use rest\models\Article;
use rest\repositories\ArticleRepository;
use rest\services\ArticleService;

/**
 * Class ArticleController
 * @package rest\controllers
 */
class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $repository;
    /**
     * @var ArticleService
     */
    private $service;
    /**
     * @var Request
     */
    private $request;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     * @param ArticleService $articleService
     * @param Request $request
     */
    public function __construct(ArticleRepository $articleRepository, ArticleService $articleService, Request $request)
    {
        $this->repository = $articleRepository;
        $this->service = $articleService;
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function actionIndex()
    {
        return $this->repository->findAll();
    }

    /**
     * @param integer $id
     * @return Article
     * @throws \Exception
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     * @return Article
     * @throws \Exception
     */
    public function actionCreate()
    {
        $bodyParams = $this->request->getBodyParams();
        $article = $this->service->create($bodyParams);

        return $article;
    }

    /**
     * @param integer $id
     * @return Article
     * @throws \Exception
     */
    public function actionUpdate($id)
    {
        $bodyParams = $this->request->getBodyParams();
        $article = $this->findModel($id);
        $article = $this->service->update($article, $bodyParams);

        return $article;
    }

    /**
     * @param integer $id
     * @return bool
     * @throws \Exception
     */
    public function actionDelete($id)
    {
        $article = $this->findModel($id);

        return $this->repository->delete($article);
    }

    /**
     * @param integer $id
     * @return Article
     * @throws \Exception
     */
    private function findModel(int $id): Article
    {
        if (!$model = $this->repository->findOne($id)) {
            throw new \Exception('Article was not found.');
        }

        return $model;
    }
}
