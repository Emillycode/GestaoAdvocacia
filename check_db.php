<?php
$pdo = new PDO('sqlite:D:\Wampp\www\escritorio-advocacia\db\database.sqlite');
$tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll();
foreach($tables as $table) {
    echo "Table: " . $table['name'] . "\n";
    $cols = $pdo->query("PRAGMA table_info(" . $table['name'] . ")")->fetchAll();
    foreach($cols as $col) {
        echo " - " . $col['name'] . "\n";
    }
}