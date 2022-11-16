<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $this->setLayout('auth');
    if ($request->isPost()) {
      return 'handle submitted data';
    }
    return $this->render('login');
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
}