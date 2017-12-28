<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/28/17
 * Time: 22:13
 */

namespace base\exceptions;

/**
 * Class HttpNotFoundException
 * @package rest\exceptions
 */
class HttpNotFoundException extends HttpException
{
    /**
     * @inheritdoc
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(404, $message ?? 'Page not found.', $code, $previous);
    }
}
