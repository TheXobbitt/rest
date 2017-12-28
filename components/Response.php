<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 13:49
 */

namespace rest\components;

use rest\collections\HeaderCollection;
use rest\helpers\ArrayHelper;
use rest\helpers\JsonHelper;

class Response
{
    private $headers;
    private $data;
    private $content;

    public function __construct($data)
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
        $this->content = JsonHelper::encode(ArrayHelper::toArray($this->data));
    }

    private function sendHeaders()
    {
        $headers = $this->getHeaders();
        foreach ($headers as $name => $value) {
            header($name . ':' . $value);
        }
    }

    private function sendContent()
    {
        echo $this->content;
    }
}
