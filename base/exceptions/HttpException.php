<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/28/17
 * Time: 22:13
 */

namespace base\exceptions;

use Throwable;

/**
 * Class HttpException
 * @package rest\exceptions
 */
class HttpException extends DomainException
{
    /**
     * @var integer
     */
    public $statusCode;

    /**
     * @inheritDoc
     */
    public function __construct($status, $message = '', $code = 0, Throwable $previous = null)
    {
        $this->statusCode = $status;
        parent::__construct($message, $code, $previous);
    }
}
