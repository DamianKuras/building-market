<?php

namespace app\base;

class View
{
    public string $title = '';

    public function renderView($view, $params = [])
    {

        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();
        $login = $this->login();
        $FinalView = str_replace('{{content}}', $viewContent, $layoutContent);
        return $FinalView;
    }
    protected function layoutContent()
    {
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

}
