<?php

namespace app\core;

class Application
{
  public static string $ROOT;
  public static Application $app;

  public Router $router; // Type property
  public Database $db;
  public Request $request;
  public Response $response;
  public Controller $controller;
  public Session $session;


  public function __construct($root, array $config)
  {
    self::$ROOT = $root;
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->session = new Session();
    $this->router = new Router($this->request);

    $this->db = new Database($config['db']);
  }

  public function run()
  {
    echo $this->router->resolve();
  }

  public function getController(): Controller
  {
    return $this->controller;
  }
  public function setController(Controller $controller): void
  {
    $this->controller = $controller;
  }
}