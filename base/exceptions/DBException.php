<?php

namespace app\base\exceptions;

use Exception;

class DBException extends Exception
{
    protected $message = 'Issues with database please try again later';
    protected $code = 503;
}
