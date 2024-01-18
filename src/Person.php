<?php
namespace Vitor\FirstStep;

class Person
{

  public $name;
  public $id;
  public function __construct(string $name, int $id)
  {
    $this->name = $name;
    $this->validationName($name);
    $this->id = $id;
  }

  private function validationName(string $name)
  {
    if (strlen($name) < 5) {
      echo "The name most contain 5 letters or more" . PHP_EOL;
      exit();
    }
  }
}
;






