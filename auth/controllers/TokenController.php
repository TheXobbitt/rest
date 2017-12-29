<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 02:02
 */

namespace auth\controllers;

use auth\services\ClientService;
use auth\services\TokenService;
use auth\services\UserService;
use base\components\Request;
use base\components\Response;

/**
 * Class TokenController
 * @package auth\controllers
 */
class TokenController extends Controller
{
    /**
     * @var TokenService
     */
    private $tokenService;
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var ClientService
     */
    private $clientService;

    /**
     * ArticleController constructor.
     * @param Request $request
     * @param Response $response
     * @param TokenService $tokenService
     * @param UserService $userService
     * @param ClientService $clientService
     */
    public function __construct(
        Request $request,
        Response $response,
        TokenService $tokenService,
        UserService $userService,
        ClientService $clientService
    )
    {
        parent::__construct($request, $response);
        $this->tokenService = $tokenService;
        $this->userService = $userService;
        $this->clientService = $clientService;
    }

    /**
     * Generates token for "Resource Owner Password Credentials" grant type.
     * @return array
     */
    public function actionGenerate()
    {
        $bodyParams = $this->request->getBodyParams();
        $clientId = (int) $bodyParams['client_id'] ?? null;
        $clientSecret = $bodyParams['client_secret'] ?? null;
        $username = $bodyParams['username'] ?? null;
        $password = $bodyParams['password'] ?? null;

        if (!isset($username) || !isset($password)) {
            $this->response->setStatusCode(400);

            return [
                'error' => 'invalid_request'
            ];
        }

        if  (
            !$this->userService->checkAccess($username, $password) ||
            !$this->clientService->checkAccess($clientId, $clientSecret)
        ) {
            $this->response->setStatusCode(400);

            return [
                'error' => 'invalid_client'
            ];
        }

        $token = $this->tokenService->generate($username);
        $this->response->getHeaders()->set('Cache-Control', 'no-store');

        return [
            'access_token' => $token->getToken(),
            'token_type' => 'bearer'
        ];
    }
}
