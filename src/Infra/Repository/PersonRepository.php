<?php

namespace Vitor\FirstStep\Infra\Repository;

use PDO;
use Vitor\FirstStep\Domain\Model\Person;
use Vitor\FirstStep\Infra\Db\SQLiteDBConnection;
use Vitor\FirstStep\Domain\Repository\IPersonRepository;

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

      $isDuplicated = $this->verifyDuplicity($id);

      if ($isDuplicated) {
        echo "User with ID $id already exists. Choose to update the record or return an error." . PHP_EOL;
        return;
      }

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
        $result = $this->hydrateUserList($statement);
        print_r($result);
      } else {
        print_r($statement->errorInfo());
      }

    } catch (\PDOException $e) {
      echo "Error: " . $e->getMessage() . PHP_EOL;
    }
  }

  public function findUnique(int $id)
  {
    try {
      $sqlQuery = "SELECT * FROM people_example WHERE id = :id";
      $statement = $this->db->getPdo()->prepare($sqlQuery);
      $statement->bindValue(':id', $id);

      if ($statement->execute()) {
        $result = $this->hydrateUserList($statement);
        print_r($result);
      } else {
        return 'Error executing query';
      }
    } catch (\PDOException $e) {
      echo "Error: " . $e->getMessage() . PHP_EOL;
    }
  }

  public function update(int $id, $name)
  {
    try {

      $sqlQueryUpdate = "UPDATE people_example SET name = :name WHERE id = :id";

      $stmt = $this->db->getPdo()->prepare($sqlQueryUpdate);

      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':id', $id);

      $stmt->execute();

      $affectedRows = $stmt->rowCount();

      if ($affectedRows > 0) {
        echo "Update successful. Rows affected: $affectedRows" . PHP_EOL;
      } else {
        echo "No rows were updated." . PHP_EOL;
      }
    } catch (\PDOException $e) {

      echo "Error: " . $e->getMessage() . PHP_EOL;
    }
  }

  public function delete($id)
  {
    try {
      $stmt = $this->db->getPdo()->prepare("DELETE FROM people_example WHERE id = :id");
      $stmt->bindParam("id", $id);
      $stmt->execute();

      $affectedRows = $stmt->rowCount();

      if ($affectedRows > 0) {
        echo "Delete user with id $id." . PHP_EOL;
      } else {
        echo "User dont exist" . PHP_EOL;
      }
    } catch (\PDOException $e) {
      echo "" . $e->getMessage() . PHP_EOL;
    }
  }

  private function verifyDuplicity(int $id)
  {
    $sqlCheck = "SELECT COUNT(*) FROM people_example WHERE id = :id";
    $checkStatement = $this->db->getPdo()->prepare($sqlCheck);
    $checkStatement->bindValue(':id', $id);
    $checkStatement->execute();

    $userExists = (bool) $checkStatement->fetchColumn();
    if ($userExists) {
      return true;
    }
  }

  private function hydrateUserList(\PDOStatement $stmt)
  {
    $personDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $list = [];

    foreach ($personDataList as $item) {
      $list[] = new Person(
        $item["name"],
        $item["id"],
      );
    }
    return $list;
  }
}
