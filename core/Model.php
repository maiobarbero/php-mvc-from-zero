<?php

namespace app\core;


abstract class Model
{
  public const REQUIRED = 'required';
  public const EMAIL = 'email';
  public const MIN_LENGTH = 'min';
  public const MAX_LENGTH = 'max';
  public const MATCH = 'match';
  public const UNIQUE = 'unique';

  public array $errors = [];

  public function loadData($data)
  {
    foreach ($data as $key => $value) {
      if (property_exists($this, $key)) {
        $this->{$key} = $value;
      }
    }
  }
  abstract public function rules(): array;
  public function validate()
  {
    foreach ($this->rules() as $attribute => $rules) {
      $value = $this->{$attribute};
      foreach ($rules as $rule) {

        // Ogni $rule può essere stringa o array
        $ruleName = $rule;
        if (!is_string($ruleName)) { //$ruleName is array
          $ruleName = $rule[0];
        }

        switch (true) {
          case ($ruleName === self::REQUIRED && !$value):
            $this->addError($attribute, self::REQUIRED);
            break;
          case ($ruleName === self::EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)):
            $this->addError($attribute, self::EMAIL);
            break;
          case ($ruleName === self::MIN_LENGTH && strlen($value) < $rule['min']):
            $this->addError($attribute, self::MIN_LENGTH, $rule);
            break;
          case ($ruleName === self::MAX_LENGTH && strlen($value) > $rule['max']):
            $this->addError($attribute, self::MAX_LENGTH, $rule);
            break;
          case ($ruleName === self::MATCH && $value != $this->{$rule['match']}):
            $this->addError($attribute, self::MATCH, $rule);
            break;
          case ($ruleName === self::UNIQUE):
            $className = $rule['class'];
            $att = $rule['attribute'] ?? $attribute;
            $tableName = $className::tableName();
            $statement = Application::$app->db->pdo->prepare("SELECT * FROM $tableName WHERE $att = :attr");
            $statement->bindValue(":attr", $value);
            $statement->execute();
            $record = $statement->fetchObject();
            if ($record) {
              $this->addError($att, self::UNIQUE);
            }
            break;

          default:
            break;
        }
      }
    }
    return empty($this->errors);
  }
  public function addError(string $attr, string $rule, $params = [])
  {

    $message = $this->errorMsg()[$rule] ?? '';
    foreach ($params as $key => $value) {
      $message = str_replace("{{$key}}", $value, $message);
    }
    $this->errors[$attr][] = $message;
  }
  public function errorMsg()
  {
    return [
      self::REQUIRED => 'This field is required.',
      self::MIN_LENGTH => 'Minimum length of this field must be {min}',
      self::MAX_LENGTH => 'Maximum length of this field must be {max}',
      self::EMAIL => 'This field must be a valid email address.',
      self::MATCH => 'This field does not corrispond to {match}',
      self::UNIQUE => 'Already in use.'
    ];
  }
  public function hasError($attr)
  {
    return $this->errors[$attr] ?? false;
  }
  public function getFirstError($attr)
  {
    return $this->errors[$attr][0] ?? false;
  }
}