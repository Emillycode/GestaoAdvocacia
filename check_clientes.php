<?php
$pdo = new PDO('sqlite:' . __DIR__ . '/db/database.sqlite');
$cols = $pdo->query("PRAGMA table_info(clientes)")->fetchAll();
print_r($cols);