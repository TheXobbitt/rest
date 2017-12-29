<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 03:01
 */

namespace auth\models;

use base\models\Model;

/**
 * Class Client
 * @package auth\models
 */
class Client extends Model
{
    /**
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $secret;
    /**
     * @var string
     */
    protected $name;

    /**
     * Client constructor.
     */
    private function __construct() {}

    /**
     * @param array $attributes
     * @return Client
     */
    public static function populate(array $attributes): Client
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
     * Checks credentials.
     * @param string $secret
     * @return bool
     */
    public function checkCredentials(string $secret)
    {
        return $this->secret === $secret;
    }
}
