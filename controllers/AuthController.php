<?php

namespace app\controllers;

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

      $this->setLayout('auth');
      // Validate data and register trough User
      $user->loadData($request->getBody());
      if ($user->validate() && $user->register()) {
        return 'Success';
      }

      return $this->render('register', [
        'model' => $user
      ]);
    }
    return $this->render('register', [
      'model' => $user
    ]);
  }
}