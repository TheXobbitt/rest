<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 13:59
 */

namespace base\components;

use Exception;
use base\collections\HeaderCollection;
use base\helpers\JsonParser;

class Request
{
    /**
     * @var HeaderCollection
     */
    private $headers;
    private $bodyParams;
    private $rawBody;

    /**
     * @return HeaderCollection
     */
    public function getHeaders()
    {
        if (!$this->headers) {
            $this->headers = new HeaderCollection();
            foreach ($_SERVER as $name => $value) {
                if (strncmp($name, 'HTTP_', 5) === 0) {
                    $name = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));
                    $this->headers->set($name, $value);
                }
            }
        }

        return $this->headers;
    }

    /**
     * @return mixed
     */
    public function getBodyParams()
    {
        if (!$this->bodyParams) {
            if (isset($_POST['_method'])) {
                $this->bodyParams = $_POST;
                unset($this->bodyParams['_method']);

                return $this->bodyParams;
            }

            $this->bodyParams = JsonParser::parse($this->getRawBody());
        }

        return $this->bodyParams;
    }

    public function getRawBody()
    {
        if (!$this->rawBody) {
            $this->rawBody = file_get_contents('php://input');
        }

        return $this->rawBody;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        if (isset($_POST['_method'])) {
            return strtoupper($_POST['_method']);
        }

        if ($this->getHeaders()->has('X-Http-Method-Override')) {
            return strtoupper($this->headers->get('X-Http-Method-Override'));
        }

        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }

        return 'GET';
    }

    /**
     * @return null|string|string[]
     * @throws Exception
     */
    public function getUrl()
    {
        if (!isset($_SERVER['REQUEST_URI'])) {
            throw new Exception('Unable to determine the request URI.');
        } else {
            $requestUri = $_SERVER['REQUEST_URI'];
            if ($requestUri !== '' && $requestUri[0] !== '/') {
                $requestUri = preg_replace('/^(http|https):\/\/[^\/]+/i', '', $requestUri);
            }
        }

        return $requestUri;
    }

    /**
     * @throws Exception
     */
    public function getPathInfo()
    {
        $pathInfo = $this->getUrl();

        if (($pos = strpos($pathInfo, '?')) !== false) {
            $pathInfo = substr($pathInfo, 0, $pos);
        }

        return $pathInfo;
    }
}
