<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/28/17
 * Time: 22:42
 */

namespace rest\exceptions;

/**
 * Class HttpValidationException
 * @package rest\exceptions
 */
class HttpValidationException extends HttpException
{
    /**
     * @inheritdoc
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(422, $message ?? 'Validation error.', $code, $previous);
    }
}
