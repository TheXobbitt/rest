<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 16:59
 */

namespace base\dto;

class UrlRule
{
    private $pattern;
    private $controller;
    private $action;
    private $method;

    public function __construct(string $pattern, string $controller, string $action, string $method)
    {
        $this->pattern = $pattern;
        $this->controller = $controller;
        $this->action = $action;
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
}
