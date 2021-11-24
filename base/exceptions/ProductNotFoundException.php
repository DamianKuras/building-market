<?php

namespace app\base\exceptions;

use Exception;

class ProductNotFoundException extends Exception
{
    protected $message = 'Produkt o podanym id nie istnieje';
    protected $code = 404;
}
