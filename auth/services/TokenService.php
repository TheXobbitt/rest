<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 02:02
 */

namespace auth\services;

use auth\models\Token;
use auth\repositories\TokenRepository;
use auth\repositories\UserRepository;
use base\helpers\HashHelper;

/**
 * Class TokenService
 * @package auth\services
 */
class TokenService
{
    /**
     * @var TokenRepository
     */
    private $tokenRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param TokenRepository $tokenRepository
     * @param UserRepository $userRepository
     */
    public function __construct(TokenRepository $tokenRepository, UserRepository $userRepository)
    {
        $this->tokenRepository = $tokenRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Generates new token
     * @param string $username
     * @return Token
     */
    public function generate(string $username): Token
    {
        $user = $this->userRepository->findOne($username);
        $hash = HashHelper::generateRandomString();

        $token = Token::create($hash, $user->getId());
        $this->tokenRepository->insert($token);

        return $token;
    }
}
