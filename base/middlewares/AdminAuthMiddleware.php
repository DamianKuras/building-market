<?php

namespace app\base\middlewares;

use app\base\Application;
use app\base\exceptions\ForbiddenException;

class AdminAuthMiddleware extends BaseMiddleware
{

    public array $actions = [];
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }
    public function execute()
    {
        if (!Application::isAdmin()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}
