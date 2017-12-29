<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 03:57
 */

namespace rest\models;

use base\models\Model;

/**
 * Class User
 * @package rest\models
 */
class User extends Model
{
    /**
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $username;
    /**
     * @var string
     */
    protected $token;

    /**
     * User constructor.
     */
    private function __construct() {}

    /**
     * @param string $username
     * @param string $token
     * @return User
     */
    public static function create(string $username, string $token): User
    {
        $model = new self();
        $model->setUsername($username);
        $model->setToken($token);

        return $model;
    }

    /**
     * @param array $attributes
     * @return User
     */
    public static function populate(array $attributes): User
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
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

}
