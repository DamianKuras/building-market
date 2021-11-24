<?php

namespace app\base;

use app\base\middlewares\AuthMiddleware;
use app\base\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = 'main';
    public string $action = '';
    public array $middlewares = [];
    public function __construct()
    {
    }
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function reigsterMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
    /**
     * @return backend\middlewares\BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
