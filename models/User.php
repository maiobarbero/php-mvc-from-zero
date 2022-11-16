<?php

namespace app\models;

use app\core\DbModel;

class User extends DbModel
{
  const STATUS_USER = 0;
  const STATUS_ADMIN = 1;
  const STATUS_EMPLOYEE = 2;

  public string $nickname = '';
  public string $email = '';
  public string $password = '';
  public string $repeat_password = '';
  public int $status = self::STATUS_USER;

  public function tableName(): string
  {
    return 'users';
  }
  public function save()
  {
    //  @todo create model Admin extend User, with is own template; Or use cli
    //  @todo create model Employee extend User, with is own template;
    $this->status = self::STATUS_USER;
    // Hash password.
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    return parent::save();
  }
  public function rules(): array
  {
    return [
      'nickname'        => [self::REQUIRED, [self::MAX_LENGTH, 'max' => 16]],
      'email'           => [self::REQUIRED, self::EMAIL, [self::UNIQUE, 'class' => self::class, 'attribute' => 'email']],
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
    return ['nickname', 'email', 'password', 'status'];
  }
}