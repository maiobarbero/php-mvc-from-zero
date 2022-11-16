<?php

use app\core\Application;

class m1668588328_user_status_default
{

  public function up()
  {
    $db = Application::$app->db;

    $sql = "ALTER TABLE users MODIFY COLUMN status TINYINT DEFAULT 0 NOT NULL";

    $db->pdo->exec($sql);
  }
  public function down()
  {
    $db = Application::$app->db;

    $sql = "ALTER TABLE users DROP COLUMN status";

    $db->pdo->exec($sql);
  }
}