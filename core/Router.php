<?php

namespace app\core;

class Router
{
  protected array $routes = [];

  public Request $request;



  public function __construct(Request $request, Response $response)
  {
    $this->request = $request;
  }
  public function get($path, $callback)
  {
    $this->routes['get'][$path] = $callback;
  }
  public function resolve()
  {
    $path = $this->request->getPath();
    $method = $this->request->getMethod();
    $callback = $this->routes[$method][$path] ?? false;


    // Path not found.
    if (!$callback) {
      Application::$app->response->setStatusCode(404);
      return "Not found!";
    }
    if (is_string($callback)) {
      return $this->renderView($callback);
    }
    return call_user_func($callback);
  }
  // Render base layout replacing placeholder {{content}}
  public function renderView($view)
  {
    $layoutContent = $this->layoutContent();
    $viewContent = $this->renderTheView($view);
    return str_replace('{{content}}', $viewContent, $layoutContent);
  }
  // Set Base layout.
  protected function layoutContent()
  {
    ob_start(); //caching output
    include_once Application::$ROOT . "/views/layouts/base.php";
    return ob_get_clean(); //return and clean the buff
  }
  // Set content to replace {{content}}
  protected function renderTheView($view)
  {
    ob_start(); //caching output
    include_once Application::$ROOT . "/views/$view.php";
    return ob_get_clean(); //return and clean the buff
  }
}