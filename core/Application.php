<?php

namespace app\core;

class Application
{
  public static string $ROOT;
  public static Application $app;

  public Router $router; // Type property
  public Request $request;
  public Response $response;

  public function __construct($root)
  {
    self::$ROOT = $root;
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request);
  }

  public function run()
  {
    echo $this->router->resolve();
  }
}