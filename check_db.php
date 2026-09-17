<?php
$pdo = new PDO('sqlite:' . __DIR__ . '/db/database.sqlite');
$tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll();
foreach($tables as $table) {
    echo "Table: " . $table['name'] . "\n";
    $cols = $pdo->query("PRAGMA table_info(" . $table['name'] . ")")->fetchAll();
    foreach($cols as $col) {
        echo " - " . $col['name'] . "\n";
    }
}