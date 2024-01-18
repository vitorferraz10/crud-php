<?php
namespace Vitor\FirstStep\Infra\Repository;

use PDO;
use Vitor\FirstStep\Infra\Db\SQLiteDBConnection;
use Vitor\FirstStep\Repository\IPersonRepository;

class PersonRepository implements IPersonRepository
{
  private $db;
  private $names;

  public function __construct()
  {
    $this->db = new SQLiteDBConnection();
  }

  public function create(string $name, int $id)
  {
    try {
      $sqlInsert = "INSERT INTO people_example (name, id) VALUES (:name, :id);";
      $statement = $this->db->getPdo()->prepare($sqlInsert);
      $statement->bindValue(':id', $id);
      $statement->bindValue(':name', $name);

      if ($statement->execute()) {
        echo "Student created" . PHP_EOL;
      } else {
        echo ($statement->errorInfo());
      }

    } catch (\PDOException $e) {
      echo "Error: " . $e->getMessage() . PHP_EOL;
    }
  }

  public function getAll()
  {
    try {

      $sqlQuery = "SELECT * FROM people_example";
      $statement = $this->db->getPdo()->query($sqlQuery);

      if ($statement->execute()) {

        return $statement->fetchAll(PDO::FETCH_ASSOC);
      } else {
        print_r($statement->errorInfo());
      }

    } catch (\PDOException $e) {
      echo "Error: " . $e->getMessage() . PHP_EOL;
    }
  }

  public function findUnique(string $nameFind)
  {
    try {

      $sqlQuery = "SELECT * FROM people_example WHERE name = $nameFind";
      $statement = $this->db->getPdo()->query($sqlQuery);

      if ($statement->execute()) {

        return $statement->fetchAll(PDO::FETCH_ASSOC);
      } else {
        return 'User not exists';
      }

    } catch (\PDOException $e) {
      echo "Error: " . $e->getMessage() . PHP_EOL;
    }

  }

  public function update(int $id, $name)
  {
    if (isset($this->names[$id])) {
      $this->names[$id] = ['name' => $name];
      return;
    }
    echo 'This name dont exists in data base';
  }

  public function delete($id)
  {
    foreach ($this->names as $key => $name) {
      if ($key == $id) {
        unset($this->names[$key]);
      } else {
        return false;
      }
    }
    return true;
  }
}