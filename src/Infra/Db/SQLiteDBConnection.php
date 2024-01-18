<?php
namespace Vitor\FirstStep\Infra\Db;
use \PDO; 

class SQLiteDBConnection
{
  private $pdo;
  private $pathDB = __DIR__ . '/../../../db.sqlite';

  public function __construct()
  {
    try {
      $this->pdo = new PDO('sqlite:' . $this->pathDB);
      echo "Connection DB!!" . PHP_EOL;
    } catch (\Exception $e) {
      die('Connection failed: ' . $e->getMessage());
    }
  }

  public function getPdo()
  {
    return $this->pdo;
  }

  public function closeConnection()
  {
    $this->pdo = null;
  }

}
