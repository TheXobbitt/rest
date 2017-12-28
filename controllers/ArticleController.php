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
    private $articleRepository;
    /**
     * @var ArticleService
     */
    private $articleService;
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
        $this->articleRepository = $articleRepository;
        $this->articleService = $articleService;
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function actionIndex()
    {
        return $this->articleRepository->findAll();
    }

    /**
     * @param integer $id
     * @return Article
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     *
     * @throws \Exception
     */
    public function actionCreate()
    {
        $bodyParams = $this->request->getBodyParams();
        $article = $this->articleService->create($bodyParams);

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
        $article = $this->articleService->update($id, $bodyParams);

        return $article;
    }

    /**
     * @param $id
     * @return bool
     */
    public function actionDelete($id)
    {
        return $this->articleRepository->delete($id);
    }

    /**
     * @param integer $id
     * @return \rest\models\Article
     */
    private function findModel(int $id): Article
    {
        return $this->articleRepository->findOne($id);
    }
}
