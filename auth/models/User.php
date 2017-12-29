<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 02:30
 */

namespace auth\models;

use base\models\Model;

/**
 * Class User
 * @package auth\models
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
    protected $password;

    /**
     * User constructor.
     */
    private function __construct() {}

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
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Checks valid password.
     * @param string $password
     * @return bool
     */
    public function checkPassword(string $password)
    {
        return $this->password === $password;
    }
}
