<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 13:25
 */

namespace rest\controllers;

use rest\components\Request;
use rest\components\Response;
use rest\exceptions\HttpNotFoundException;
use rest\exceptions\HttpServerException;
use rest\exceptions\HttpValidationException;
use rest\exceptions\ValidationException;
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
     * ArticleController constructor.
     * @param Request $request
     * @param Response $response
     * @param ArticleRepository $articleRepository
     * @param ArticleService $articleService
     */
    public function __construct(Request $request, Response $response, ArticleRepository $articleRepository, ArticleService $articleService)
    {
        parent::__construct($request, $response);
        $this->repository = $articleRepository;
        $this->service = $articleService;
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
        try {
            $article = $this->service->create($bodyParams);
            $this->response->setStatusCode(201);
            $this->response->getHeaders()->set('Location', '/article/' . $article->getId());
        } catch (ValidationException $exception) {
            throw new HttpValidationException($exception->getMessage());
        } catch (\Exception $exception) {
            throw new HttpServerException('Article could not be saved.');
        }

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
            throw new HttpNotFoundException('Article was not found.');
        }

        return $model;
    }
}
