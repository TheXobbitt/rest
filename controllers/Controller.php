<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 13:44
 */

namespace rest\controllers;

use rest\components\Response;

class Controller
{
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
            throw new \Exception('Action does not exist.');
        }

        $data = call_user_func_array([$this, $action], $args);
        $response = new Response($data);
        $response->getHeaders()->set('Content-Type', 'application/json;charset=UTF-8');

        return $response;
    }
}
