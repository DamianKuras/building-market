<?php

namespace app\base;

class View
{
    public string $title = '';

    // public function renderContent($viewContent)
    // {
    //     $layoutContent = $this->layoutContent();
    //     return str_replace('{{content}}', $viewContent, $layoutContent);
    // }

    public function renderView($view, $params = [])
    {

        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();
        $login = $this->login();
        $FinalView = str_replace('{{content}}', $viewContent, $layoutContent);
        $FinalView = str_replace('{{login}}', $login, $FinalView);
        return $FinalView;
    }
    protected function layoutContent()
    {
        // $layout = Application::$app->layout;
        $layout = Application::$app->controller->layout ?? 'main';
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }
    protected function login(){
        return "";
    }
    protected function renderOnlyView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
    // protected function renderOnlyPartial($partialView, $params = [])
    // {
    //     foreach ($params as $key => $value) {
    //         $$key = $value;
    //     }
    //     ob_start();
    //     include_once Application::$ROOT_DIR . "/views/partials/$partialView.php";
    //     return ob_get_clean();
    // }
}
