<?php

require_once 'vendor/autoload.php';

use Vitor\FirstStep\Infra\Repository\PersonRepository;
use Vitor\FirstStep\Person;

 $vitor = new Person('Isabela', 1);

$userRepository = new PersonRepository();

$userRepository->create($vitor->name, $vitor->id);








