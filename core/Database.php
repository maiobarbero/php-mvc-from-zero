<?php

namespace app\core;



class Database
{
  public \PDO $pdo;

  public function __construct(array $config)
  {
    $socket = $config['socket'] ?? '';
    $user = $config['user'] ?? '';
    $password = $config['password'] ?? '';

    $this->pdo = new \PDO('mysql:unix_socket=/Users/maiobarbero/Library/Application Support/Local/run/YrAW4tLox/mysql/mysqld.sock;dbname=local', 'root', 'root');
    $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
  }

  public function applyMigrations()
  {
    $this->createMigrationsTable();
    $applied = $this->getAppliedMigrations();

    $newMigrations = [];

    $files = scandir(Application::$ROOT . '/migrations');

    $toApply = array_diff($files, $applied);

    foreach ($toApply as $migration) {
      if ($migration === '.' || $migration === '..') {
        continue;
      }
      require_once Application::$ROOT . '/migrations/' . $migration;
      $className = pathinfo($migration, PATHINFO_FILENAME); //filenmae without extension
      $instance = new $className;

      $this->log("Applying migration $migration");
      $instance->up();
      $this->log("$migration applied");
      $newMigrations[] = $migration;
    }

    if (!empty($newMigrations)) {
      $this->saveMigrations($newMigrations);
    } else {
      $this->log('All migrations are applied');
    }
  }
  public function createMigrationsTable()
  {
    $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
      id INT AUTO_INCREMENT PRIMARY KEY,
      migration VARCHAR(255),
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB;");
  }
  public function getAppliedMigrations()
  {
    // Do not apply migrations already applied
    $statement = $this->pdo->prepare("SELECT migration FROM migrations");
    $statement->execute();

    return $statement->fetchAll(\PDO::FETCH_COLUMN); //fetch every migration column as single dimension array
  }
  public function saveMigrations(array $migrations)
  {
    $migrations = array_map(fn ($m) => "('$m')", $migrations); // es m0001_initial.php diventa ('m0001_initial.php')
    $str = implode(",", $migrations);
    $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES
    $str
    ");
    $statement->execute();
  }
  protected function log(string $msg)
  {
    echo '[' . date('d-m-Y H:i:s') . '] - ' . $msg . PHP_EOL;
  }
}