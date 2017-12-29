<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 13:44
 */

namespace rest\controllers;

use base\components\Request;
use base\components\Response;
use base\exceptions\HttpForbiddenException;
use base\exceptions\HttpNotFoundException;
use rest\repositories\UserRepository;

/**
 * Class Controller
 * @package rest\controllers
 */
class Controller
{
    private $collectionOptions = ['GET', 'POST', 'OPTIONS'];
    private $resourceOptions = ['GET', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];
    /**
     * Specifies actions to check access.
     * @var array
     */
    protected $checkActions = [];
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Response
     */
    protected $response;
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Controller constructor.
     * @param Request $request
     * @param Response $response
     * @param UserRepository $userRepository
     */
    public function __construct(Request $request, Response $response, UserRepository $userRepository)
    {
        $this->request = $request;
        $this->response = $response;
        $this->userRepository = $userRepository;
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
            throw new HttpNotFoundException('Action does not exist.');
        }

        if (!$this->checkAccess($actionId)) {
            throw new HttpForbiddenException('Action is forbidden.');
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

    /**
     * @param string $actionId
     * @return bool
     */
    protected function checkAccess($actionId): bool
    {
        if (!in_array($actionId, $this->checkActions)) {
            return true;
        }
        if (!$token = $this->request->getBearerToken()) {
            return false;
        }

        return $this->userRepository->existByToken($token);
    }
}
