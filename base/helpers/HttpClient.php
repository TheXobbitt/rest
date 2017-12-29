<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 04:07
 */

namespace base\helpers;

use base\exceptions\DomainException;

/**
 * Class HttpClient
 * @package base\helpers
 */
class HttpClient
{
    /**
     * @param string $url
     * @param array $params
     * @return mixed
     */
    public static function post(string $url, array $params = [])
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

        $response = JsonHelper::decode($server_output);
        if (isset($response['error'])) {
            throw new DomainException('Error while sending request');
        }

        return $response;
    }
}
