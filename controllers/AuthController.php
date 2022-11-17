<?php

namespace app\controllers;

use app\models\User;
use app\core\Request;
use app\core\Response;
use app\core\Controller;
use app\core\Application;
use app\models\LoginForm;

class AuthController extends Controller
{
  public function login(Request $request, Response $response)
  {
    $loginForm = new LoginForm();

    if ($request->isPost()) {
      $loginForm->loadData($request->getBody());

      if ($loginForm->validate() && $loginForm->login()) {

        //Redirect.
        $response->redirect('/');

        return;
      }
    }

    $this->setLayout('auth');
    return $this->render('login', [
      'model' => $loginForm
    ]);
  }
  public function register(Request $request)
  {
    $user = new User();
    if ($request->isPost()) {
      // Validate data and register trough User
      $user->loadData($request->getBody());

      if ($user->validate() && $user->save()) {
        //session flash message
        Application::$app->session->setFlash('success', 'Thanks for registering.');
        //Redirect.
        Application::$app->response->redirect('/');
        exit;
      }

      return $this->render('register', [
        'model' => $user
      ]);
    }
    $this->setLayout('auth');
    return $this->render('register', [
      'model' => $user
    ]);
  }
  public function logout(Request $request, Response $response)
  {
    Application::$app->logout();
    $response->redirect('/');
  }
}