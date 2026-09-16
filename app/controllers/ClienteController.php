<?php
class ClienteController {
    public function index() {
        $pdo = getDB();
        $clientes = $pdo->query("SELECT * FROM clientes ORDER BY nome ASC")->fetchAll();
        $content = 'app/views/clientes/index.php';
        require 'app/views/layout.php';
    }

    public function create() {
        $content = 'app/views/clientes/form.php';
        require 'app/views/layout.php';
    }

    public function store() {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefone = $_POST['telefone'] ?? '';
        $cpf_cnpj = $_POST['cpf_cnpj'] ?? '';

        $pdo = getDB();
        $stmt = $pdo->prepare("INSERT INTO clientes (nome, email, telefone, cpf_cnpj) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $telefone, $cpf_cnpj]);
        
        $_SESSION['flash_msg'] = "Cliente cadastrado com sucesso!";
        redirect('/clientes');
    }
}
