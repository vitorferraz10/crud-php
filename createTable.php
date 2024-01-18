<?php

use Vitor\FirstStep\Infra\Db\SQLiteDBConnection;

$pdo = new SQLiteDBConnection();
$pdo->getPdo()->exec("CREATE TABLE new_person (
  name TEXT,
  id INTEGER
);");