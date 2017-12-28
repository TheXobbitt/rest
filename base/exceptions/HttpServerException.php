<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/28/17
 * Time: 22:39
 */

namespace base\exceptions;

/**
 * Class HttpServerException
 * @package rest\exceptions
 */
class HttpServerException extends HttpException
{
    /**
     * @inheritdoc
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(500, $message ?? 'Something goes wrong.', $code, $previous);
    }
}
