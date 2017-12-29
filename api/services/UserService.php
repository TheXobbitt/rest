<?php
/**
 * Created by PhpStorm.
 * User: xobbitt
 * Date: 12/29/17
 * Time: 04:03
 */

namespace rest\services;

use rest\models\User;
use rest\repositories\UserRepository;

/**
 * Class UserService
 * @package rest\services
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var OAuthService
     */
    private $authService;

    /**
     * ArticleService constructor.
     * @param UserRepository $repository
     * @param OAuthService $authService
     */
    public function __construct(UserRepository $repository, OAuthService $authService)
    {
        $this->repository = $repository;
        $this->authService = $authService;
    }

    /**
     * @param string $username
     * @param string $password
     * @return string
     */
    public function getToken(string $username, string $password): string
    {
        $token = $this->authService->send($username, $password);
        if (!$user = $this->repository->findOne($username)) {
            $user =  User::create($username, $token);
            $this->repository->insert($user);
        } else {
            $user->setToken($token);
            $this->repository->update($user);
        }

        return $user->getToken();
    }
}
