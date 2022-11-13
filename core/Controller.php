<?php

namespace app\core;

class Controller
{
  public string $layout = 'base';

  public function render($view, $params = [])
  {
    return Application::$app->router->renderView($view, $params);
  }
  public function setLayout(string $layout)
  {
    $this->layout = $layout;
  }
}