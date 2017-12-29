<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 02:29
 */

namespace auth\services;


use auth\repositories\UserRepository;

/**
 * Class UserService
 * @package auth\services
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function checkAccess(string $username, string $password)
    {
        $user = $this->repository->findOne($username);
        return $user->checkPassword($password);
    }
}
