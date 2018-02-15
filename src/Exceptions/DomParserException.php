<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 15.02.2018
 */

namespace Exceptions;


use Throwable;

class DomParserException extends \Exception
{
    public function __construct(string $message, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}