<?php
$file = 'D:\Wampp\www\escritorio-advocacia\app\controllers\ClienteController.php';
$content = file_get_contents($file);

// index
$content = str_replace(
    '$clientes = $pdo->query("SELECT * FROM clientes ORDER BY nome ASC")->fetchAll();',
    '$stmt = $pdo->prepare("SELECT * FROM clientes WHERE usuario_id = ? ORDER BY nome ASC"); $stmt->execute([$_SESSION["user_id"]]); $clientes = $stmt->fetchAll();',
    $content
);

// store
$content = str_replace(
    'INSERT INTO clientes (nome, email, telefone, cpf_cnpj, observacao) VALUES (?, ?, ?, ?, ?)',
    'INSERT INTO clientes (nome, email, telefone, cpf_cnpj, observacao, usuario_id) VALUES (?, ?, ?, ?, ?, ?)',
    $content
);
$content = str_replace(
    '$stmt->execute([$nome, $email, $telefone, $cpf_cnpj, $observacao]);',
    '$stmt->execute([$nome, $email, $telefone, $cpf_cnpj, $observacao, $_SESSION["user_id"]]);',
    $content
);

// edit
$content = str_replace(
    'SELECT * FROM clientes WHERE id = ?',
    'SELECT * FROM clientes WHERE id = ? AND usuario_id = ?',
    $content
);
$content = preg_replace(
    '/\$stmt->execute\(\[\$id\]\);/',
    '$stmt->execute([$id, $_SESSION["user_id"]]);',
    $content,
    1 // replace only the first occurrence for edit
);

// update
$content = str_replace(
    'UPDATE clientes SET nome=?, email=?, telefone=?, cpf_cnpj=?, observacao=? WHERE id=?',
    'UPDATE clientes SET nome=?, email=?, telefone=?, cpf_cnpj=?, observacao=? WHERE id=? AND usuario_id=?',
    $content
);
$content = str_replace(
    '$stmt->execute([$nome, $email, $telefone, $cpf_cnpj, $observacao, $id]);',
    '$stmt->execute([$nome, $email, $telefone, $cpf_cnpj, $observacao, $id, $_SESSION["user_id"]]);',
    $content
);

// delete
$content = str_replace(
    'DELETE FROM clientes WHERE id = ?',
    'DELETE FROM clientes WHERE id = ? AND usuario_id = ?',
    $content
);
$content = preg_replace(
    '/\$stmt->execute\(\[\$id\]\);/',
    '$stmt->execute([$id, $_SESSION["user_id"]]);',
    $content,
    1 // replace the next occurrence which is in delete
);

file_put_contents($file, $content);
echo "ClienteController updated!\n";