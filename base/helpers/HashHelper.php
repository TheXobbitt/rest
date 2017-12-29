<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 03:32
 */

namespace base\helpers;

use Exception;

/**
 * Class HashHelper
 * @package base\helpers
 */
class HashHelper
{
    /**
     * Generates random string.
     * @return string
     */
    public static function generateRandomString()
    {
        try {
            return md5(time() . random_int(PHP_INT_MIN, PHP_INT_MAX));
        } catch (Exception $exception) {
            return md5(time());
        }
    }
}
