<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/28/17
 * Time: 22:13
 */

namespace base\exceptions;

/**
 * Class HttpForbiddenException
 * @package rest\exceptions
 */
class HttpForbiddenException extends HttpException
{
    /**
     * @inheritdoc
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(403, $message ?? 'Forbidden.', $code, $previous);
    }
}
