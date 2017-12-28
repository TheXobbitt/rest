<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 15:44
 */

namespace rest\helpers;

class JsonHelper
{
    /**
     * @param array $data
     * @return string
     */
    public static function encode(array $data): string
    {
        return json_encode($data);
    }

    /**
     * @param string $data
     * @param bool $assoc
     * @return mixed
     */
    public static function decode(string $data, $assoc = true)
    {
        return json_decode($data, $assoc);
    }
}
