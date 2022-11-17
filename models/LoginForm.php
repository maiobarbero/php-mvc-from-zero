<?php

namespace app\models;

use app\core\Application;
use app\core\Model;


class LoginForm extends Model
{
  public string $email = '';
  public string $password = '';

  public function rules(): array
  {
    return [
      'email' => [self::REQUIRED, self::EMAIL],
      'password' => [self::REQUIRED]
    ];
  }
  public function login()
  {

    $user = (new User())->findOne(['email' => $this->email]);
    if (!$user) {
      $this->error('email', 'User with this email address does not exists.');
      return false;
    }
    if (!password_verify($this->password, $user->password)) {
      $this->error('password', 'Wrong password.');
      return false;
    }

    return Application::$app->login($user);
  }
}