<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/26/17
 * Time: 20:11
 */

namespace rest\components;

use Exception;
use rest\controllers\Controller;
use rest\exceptions\DomainException;
use rest\exceptions\HttpException;

/**
 * Class Application
 * @package rest\components
 */
class Application
{
    /**
     * @var Router
     */
    private $router;

    /**
     * Application constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Runs application.
     */
    public function run()
    {
        try {
            $request = Container::getInstance()->get('request');
            $response = $this->handleRequest($request);
        } catch (Exception $exception) {
            $response = $this->handleError($exception);
        }

        $response->send();
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    private function handleRequest(Request $request)
    {
        list ($controllerId, $actionId, $args) = $this->router->parseRequest($request);

        $controller = $this->createController($controllerId);
        $response = $controller->run($actionId, $args);

        return $response;
    }

    /**
     * @param string $id
     * @return Controller
     * @throws Exception
     */
    private function createController(string $id)
    {
        $className = sprintf('\\rest\\controllers\\%sController', ucfirst($id));
        if (!class_exists($className)) {
            throw new Exception('Class does not exist');
        }

        Container::getInstance()->setShared($className, $className);
        $controller = Container::getInstance()->get($className);

        return $controller;
    }

    /**
     * @param Exception $exception
     * @return Response
     */
    private function handleError(Exception $exception): Response
    {
        $response = new Response();
        $response->setData([
            'Success' => false,
            'Message' => $exception->getMessage()
        ]);
        if ($exception instanceof HttpException) {
            $response->setStatusCode($exception->statusCode);
        } elseif ($exception instanceof DomainException) {
            $response->setStatusCode(500);
        }

        return $response;
    }
}
