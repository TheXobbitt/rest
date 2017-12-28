<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 19:15
 */

namespace rest\helpers;

use Exception;

/**
 * Class JsonParser
 * @package rest\helpers
 */
class JsonParser
{
    /**
     * @param $rawBody
     * @return array|mixed
     */
    public static function parse($rawBody)
    {
        try {
            $parameters = JsonHelper::decode($rawBody);

            return $parameters === null ? [] : $parameters;
        } catch (Exception $exception) {
            return [];
        }
    }
}
