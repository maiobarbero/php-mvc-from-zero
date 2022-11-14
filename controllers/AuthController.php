<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

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
    $registerModel = new RegisterModel();
    if ($request->isPost()) {

      $this->setLayout('auth');
      // Validate data and register trough RegisterModel
      $registerModel->loadData($request->getBody());
      if ($registerModel->validate() && $registerModel->register()) {
        return 'Success';
      }

      return $this->render('register', [
        'model' => $registerModel
      ]);
    }
    return $this->render('register', [
      'model' => $registerModel
    ]);
  }
}