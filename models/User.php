<?php

namespace app\models;

use app\core\DbModel;

class User extends DbModel
{
  public string $nickname = '';
  public string $email = '';
  public string $password = '';
  public string $repeat_password = '';

  public function tableName(): string
  {
    return 'user';
  }

  public function rules(): array
  {
    return [
      'nickname'        => [self::REQUIRED, [self::MAX_LENGTH, 'max' => 16]],
      'email'           => [self::REQUIRED, self::EMAIL],
      'password'        => [self::REQUIRED, [self::MIN_LENGTH, 'min' => 8]],
      'repeat_password' => [self::REQUIRED, [self::MATCH, 'match' => 'password']],
    ];
  }
  public function register()
  {
    return $this->save();
  }
  public function attributes(): array
  {
    return ['nickname', 'email', 'password'];
  }
}