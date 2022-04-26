<?php

namespace app\base\exceptions;

use Exception;

class ProductNotFoundException extends Exception
{
    protected $message = 'Product with specified id does not exits';
    protected $code = 404;
}
