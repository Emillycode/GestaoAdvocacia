<?php
$pdo = new PDO('sqlite:D:\Wampp\www\escritorio-advocacia\db\database.sqlite');
$cols = $pdo->query("PRAGMA table_info(clientes)")->fetchAll();
print_r($cols);