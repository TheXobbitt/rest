<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 13:44
 */

namespace rest\controllers;

use rest\components\Request;
use rest\components\Response;
use yii\web\NotFoundHttpException;

class Controller
{
    private $collectionOptions = ['GET', 'POST', 'HEAD', 'OPTIONS'];
    private $resourceOptions = ['GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'];
    protected $request;
    protected $response;

    /**
     * Controller constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param string $actionId
     * @param array $args
     * @return Response
     * @throws \Exception
     */
    public function run(string $actionId, $args = []): Response
    {
        $action = sprintf('action%s', ucfirst($actionId));
        if (!method_exists($this, $action)) {
            throw new NotFoundHttpException('Action does not exist.');
        }

        $data = call_user_func_array([$this, $action], $args);
        $this->response->setData($data);

        return $this->response;
    }

    /**
     * Options action. Shows what methods are available.
     * @param null $id
     */
    public function actionOptions($id = null)
    {
        $options = ($id === null) ? $this->collectionOptions : $this->resourceOptions;
        $this->response->getHeaders()->set('Allow', implode(', ', $options));
    }
}
