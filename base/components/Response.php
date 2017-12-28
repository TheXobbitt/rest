<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 13:49
 */

namespace base\components;

use base\collections\HeaderCollection;
use base\helpers\ArrayHelper;
use base\helpers\JsonHelper;

class Response
{
    private $headers;
    private $statusCode = 200;
    private $statusMessage = 'OK';
    private $data;
    private $content;
    private $httpStatuses = [
        200 => 'OK',
        201 => 'Created',
        204 => 'No Content',
        400 => 'Bad Request',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        422 => 'Unprocessable entity',
        500 => 'Internal Server Error',
    ];

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
        $this->statusMessage = $this->httpStatuses[$statusCode] ?? 'OK';
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    public function getHeaders()
    {
        if (!$this->headers) {
            $this->headers = new HeaderCollection();
        }

        return $this->headers;
    }

    public function send()
    {
        $this->prepare();
        $this->sendHeaders();
        $this->sendContent();
    }

    private function prepare()
    {
        $this->content = isset($this->data) ? JsonHelper::encode(ArrayHelper::toArray($this->data)) : null;
    }

    private function sendHeaders()
    {
        $headers = $this->getHeaders();
        foreach ($headers as $name => $value) {
            header($name . ':' . $value);
        }
        header('Content-Type:application/json; charset=UTF-8');
        header("HTTP/1.1 $this->statusCode $this->statusMessage");
    }

    private function sendContent()
    {
        echo $this->content;
    }
}
