<?php

require_once 'vendor/autoload.php';

use Vitor\FirstStep\Infra\Repository\PersonRepository;
use Vitor\FirstStep\Domain\Model\Person;

//  $ney = new Person('Neymar', 11);

$userRepository = new PersonRepository();

// $userRepository->create($ney->name, $ney->id);

 $userRepository->delete(1);

$userRepository->getAll();

// $userRepository->findUnique(11);








