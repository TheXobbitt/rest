<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/29/17
 * Time: 02:55
 */

namespace base\exceptions;

/**
 * Class HttpBadRequestException
 * @package base\exceptions
 */
class HttpBadRequestException extends HttpException
{
    /**
     * @inheritdoc
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(400, $message ?? 'Bad request.', $code, $previous);
    }
}
