<?php

require_once 'vendor/autoload.php';

use Vitor\FirstStep\Infra\Repository\PersonRepository;
use Vitor\FirstStep\Domain\Model\Person;

 $vitor = new Person('Cristiano Ronaldo', 7);

$userRepository = new PersonRepository();


$userRepository->findUnique(10);

// $userRepository->findUnique(11);








