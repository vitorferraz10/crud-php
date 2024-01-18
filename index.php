<?php

require_once 'vendor/autoload.php';

use Vitor\FirstStep\Infra\Repository\PersonRepository;
use Vitor\FirstStep\Domain\Model\Person;

 $vitor = new Person('Lionel Messi', 10);

$userRepository = new PersonRepository();

$userRepository->create($vitor->name, $vitor->id);








