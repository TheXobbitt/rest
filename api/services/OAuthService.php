<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 04:11
 */

namespace rest\services;

use base\exceptions\DomainException;
use base\exceptions\ValidationException;
use base\helpers\HttpClient;

/**
 * Class OAuthService
 * @package rest\services
 */
class OAuthService
{
    /**
     * @var string
     */
    private $grant_type = 'password';
    /**
     * @var int
     */
    private $clientId = 1;
    /**
     * @var string
     */
    private $clientSecret = '202cb962ac59075b964b07152d234b70';

    /**
     * @param string $username
     * @param string $password
     * @return string
     */
    public function send(string $username, string $password): string
    {
        try {
            $response = HttpClient::post('http://auth/token', [
                'grant_type' => $this->grant_type,
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'username' => $username,
                'password' => $password
            ]);
        } catch (DomainException $exception) {
            throw new ValidationException('Incorrect username or password');
        }

        return $response['access_token'];
    }
}
