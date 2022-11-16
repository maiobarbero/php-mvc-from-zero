<?php

namespace app\core;


abstract class DbModel extends Model
{
  abstract public function tableName(): string;
  abstract public function attributes(): array;

  public function save()
  {
    $tableName = $this->tableName();
    $attributes = $this->attributes();
    $params = array_map(fn ($attribute) => ":$attribute", $attributes);
    $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")");

    foreach ($attributes as $attr) {
      $statement->bindParam(":$attr", $this->{$attr});
    }
    $statement->execute();
  }
  public static function prepare($sql)
  {
    return
      $db = Application::$app->db->pdo->prepare($sql);
  }
}