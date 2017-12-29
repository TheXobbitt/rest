<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 02:03
 */

namespace auth\controllers;

use base\components\Request;
use base\components\Response;
use base\exceptions\HttpNotFoundException;

/**
 * Class Controller
 * @package auth\controllers
 */
class Controller
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Response
     */
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
            throw new HttpNotFoundException('Action does not exist.');
        }

        $data = call_user_func_array([$this, $action], $args);
        $this->response->setData($data);

        return $this->response;
    }

}