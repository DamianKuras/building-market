<?php

namespace app\base\exceptions;

use Exception;

class ForbiddenException extends Exception
{
    protected $message = 'You dont\'t have perission to access this page';
    protected $code = 403;
}
