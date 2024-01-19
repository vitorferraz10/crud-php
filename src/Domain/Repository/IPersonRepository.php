<?php
namespace Vitor\FirstStep\Domain\Repository;

interface IPersonRepository
{

  public function create(string $name, int $id);
  public function getAll();

  public function findUnique(int $id);

  public function update(int $id, $name);
  public function delete(int $id);

}

