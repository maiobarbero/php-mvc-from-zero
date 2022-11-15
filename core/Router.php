<?php

namespace app\core;


class Router
{
  protected array $routes = [];

  public Request $request;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }
  public function get($path, $callback)
  {
    $this->routes['get'][$path] = $callback;
  }
  public function post($path, $callback)
  {
    $this->routes['post'][$path] = $callback;
  }
  public function resolve()
  {
    $path = $this->request->getPath();
    $method = $this->request->getMethod();
    $callback = $this->routes[$method][$path] ?? false;


    // Path not found.
    if (!$callback) {
      Application::$app->response->setStatusCode(404);
      $layoutContent = $this->layoutContent();
      $viewContent = $this->renderTheView('404', []);
      return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    // If $callback is string render the view.
    if (is_string($callback)) {
      return $this->renderView($callback);
    }
    // If $callback is array create instance of controller class (It's the first element of the array).
    if (is_array($callback)) {
      Application::$app->controller = new $callback[0];
      $callback[0] = Application::$app->controller;
    }
    return call_user_func($callback, $this->request);
  }
  // Render base layout replacing placeholder {{content}}
  public function renderView($view, $params = [])
  {
    $layoutContent = $this->layoutContent();
    $viewContent = $this->renderTheView($view, $params);
    return str_replace('{{content}}', $viewContent, $layoutContent);
  }
  // Set Base layout.
  protected function layoutContent()
  {
    $layout = Application::$app->controller->layout;
    ob_start(); //caching output
    include_once Application::$ROOT . "/views/layouts/$layout.php";
    return ob_get_clean(); //return and clean the buff
  }
  // Set content to replace {{content}}
  protected function renderTheView($view, $params)
  {
    // create variable for each params
    foreach ($params as $key => $value) {
      $$key = $value;
    }

    ob_start(); //caching output
    include_once Application::$ROOT . "/views/$view.php";
    return ob_get_clean(); //return and clean the buff
  }
}