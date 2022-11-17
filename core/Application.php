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
  public ?Controller $controller = null;
  public Session $session;
  public ?DbModel $user;

  public string $userClass;
  public string $layout = 'base';


  public function __construct($root, array $config)
  {
    self::$ROOT = $root;
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->session = new Session();
    $this->router = new Router($this->request, $this->response);

    $this->db = new Database($config['db']);

    $this->userClass = $config['userClass'];
    $primaryValue = $this->session->get('user');
    if ($primaryValue) {
      $primaryKey = (new $this->userClass)->primaryKey();
      $this->user = (new $this->userClass)->findOne([$primaryKey => $primaryValue]);
    } else {
      $this->user = null;
    }
  }

  public function run()
  {
    try {
      echo $this->router->resolve();
    } catch (\Exception $e) {
      $this->response->setStatusCode($e->getCode());
      echo $this->router->renderView('_error', [
        'exception' => $e
      ]);
    }
  }

  public function getController(): Controller
  {
    return $this->controller;
  }
  public function setController(Controller $controller): void
  {
    $this->controller = $controller;
  }

  public function login(DbModel $user)
  {
    $this->user = $user;
    $primaryKey = $user->primaryKey();
    $primaryValue = $user->{$primaryKey};

    $this->session->set('user', $primaryValue);
    return true;
  }
  public function logout()
  {
    $this->user = null;
    $this->session->remove('user');
  }
  public static function isGuest()
  {
    return !self::$app->user;
  }
}