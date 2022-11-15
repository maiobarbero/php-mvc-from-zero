<?php

use \app\core\Application;

fwrite(STDOUT, "Insert migration name:\n");
$migrationName = 'm' . time() . '_' . strtolower(str_replace(' ', '_', fgets(STDIN)));

$path = './migrations/' . $migrationName . '.php';
$migration = fopen($path, "w",);

$migrationBody = '<?php

use app\core\Application;

class ' . $migrationName . '
{

  public function up()
  {
    $db = Application::$app->db;

    $sql = "";

    $db->pdo->exec($sql);
  }
  public function down()
  {
    $db = Application::$app->db;

    $sql = "";

    $db->pdo->exec($sql);
  }
}
';
fwrite($migration, $migrationBody);
fclose($migration);