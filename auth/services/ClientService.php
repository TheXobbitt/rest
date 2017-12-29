<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 03:00
 */

namespace auth\services;

use auth\repositories\ClientRepository;

/**
 * Class ClientService
 * @package auth\services
 */
class ClientService
{
    /**
     * @var ClientRepository
     */
    private $repository;

    /**
     * UserService constructor.
     * @param ClientRepository $repository
     */
    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param integer $id
     * @param string $secret
     * @return bool
     */
    public function checkAccess(int $id, string $secret)
    {
        if (!$client = $this->repository->findOne($id)) {
            return false;
        }

        return $client->checkCredentials($secret);
    }
}
