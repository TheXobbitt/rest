<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 03:56
 */

namespace rest\controllers;

use base\components\Request;
use base\components\Response;
use base\exceptions\HttpValidationException;
use base\exceptions\ValidationException;
use rest\repositories\UserRepository;
use rest\services\UserService;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * UserController constructor.
     * @param Request $request
     * @param Response $response
     * @param UserRepository $userRepository
     * @param UserService $service
     */
    public function __construct(Request $request, Response $response, UserRepository $userRepository, UserService $service)
    {
        parent::__construct($request, $response, $userRepository);
        $this->service = $service;
    }

    /**
     * @return array
     */
    public function actionLogin()
    {
        $bodyParams = $this->request->getBodyParams();
        $username = $bodyParams['username'] ?? '';
        $password = $bodyParams['password'] ?? '';

        try {
            $token = $this->service->getToken($username, $password);
        } catch (ValidationException $exception) {
            throw new HttpValidationException($exception->getMessage());
        }

        return [
            'token' => $token
        ];
    }
}
