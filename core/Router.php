<?php

namespace app\core;

use app\core\exception\NotFoundException;

class Router
{
  protected array $routes = [];

  public Request $request;
  public Response $response;



  public function __construct(Request $request, Response $response)
  {
    $this->request = $request;
    $this->response = $response;
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
      throw new NotFoundException();
    }
    // If $callback is string render the view.
    if (is_string($callback)) {
      return $this->renderView($callback);
    }
    // If $callback is array create instance of controller class (It's the first element of the array).
    if (is_array($callback)) {

      /** @var \app\core\Controller $controller */

      $controller = new $callback[0]();
      Application::$app->controller = $controller;
      $controller->action = $callback[1];
      foreach ($controller->getMiddlewares() as $middleware) {
        $middleware->execute();
      }
    }
    return call_user_func($callback, $this->request, $this->response);
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
    $layout = Application::$app->layout;

    if (Application::$app->controller) {
      $layout = Application::$app->controller->layout;
    }
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