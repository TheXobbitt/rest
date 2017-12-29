<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 02:01
 */

namespace auth\models;

use base\models\Model;

/**
 * Class Token
 * @package auth\models
 */
class Token extends Model
{
    protected $token;
    protected $userId;

    /**
     * Token constructor.
     */
    private function __construct() {}

    /**
     * @param string $token
     * @param int $userId
     * @return Token
     */
    public static function create(string $token, int $userId): Token
    {
        $model = new self();
        $model->setToken($token);
        $model->setUserId($userId);

        return $model;
    }

    /**
     * @param array $attributes
     * @return Token
     */
    public static function populate(array $attributes): Token
    {
        $model = new self();
        foreach ($attributes as $attribute => $value) {
            if (property_exists($model, $attribute)) {
                $model->$attribute = $value;
            }
        }

        return $model;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }
}
