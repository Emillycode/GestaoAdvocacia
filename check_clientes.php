<?php
<<<<<<< HEAD
$pdo = new PDO('sqlite:' . __DIR__ . '/db/database.sqlite');
=======
$pdo = new PDO('sqlite:D:\Wampp\www\escritorio-advocacia\db\database.sqlite');
>>>>>>> bd18950110dbebd2dc03d6cf49fac0958c0e65ec
$cols = $pdo->query("PRAGMA table_info(clientes)")->fetchAll();
print_r($cols);