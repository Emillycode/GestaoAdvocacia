<?php
class ClienteController {
    public function index() {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM clientes WHERE usuario_id = ? ORDER BY nome ASC"); $stmt->execute([$_SESSION["user_id"]]); $clientes = $stmt->fetchAll();
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
        $observacao = $_POST['observacao'] ?? '';

        $pdo = getDB();
        $stmt = $pdo->prepare("INSERT INTO clientes (nome, email, telefone, cpf_cnpj, observacao, usuario_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $telefone, $cpf_cnpj, $observacao, $_SESSION["user_id"]]);
        
        $_SESSION['flash_msg'] = "Cliente cadastrado com sucesso!";
        redirect('/clientes');
    }

    public function edit($id) {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$id, $_SESSION["user_id"]]);
        $cliente = $stmt->fetch();
        if (!$cliente) {
            $_SESSION['flash_err'] = "Cliente não encontrado.";
            redirect('/clientes');
        }
        $content = 'app/views/clientes/edit.php';
        require 'app/views/layout.php';
    }

    public function update($id) {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefone = $_POST['telefone'] ?? '';
        $cpf_cnpj = $_POST['cpf_cnpj'] ?? '';
        $observacao = $_POST['observacao'] ?? '';

        $pdo = getDB();
        $stmt = $pdo->prepare("UPDATE clientes SET nome=?, email=?, telefone=?, cpf_cnpj=?, observacao=? WHERE id=? AND usuario_id=?");
        $stmt->execute([$nome, $email, $telefone, $cpf_cnpj, $observacao, $id, $_SESSION["user_id"]]);
        
        $_SESSION['flash_msg'] = "Cliente atualizado com sucesso!";
        redirect('/clientes');
    }

    public function delete($id) {
        $pdo = getDB();
        try {
<<<<<<< HEAD
            // Excluir prazos vinculados aos processos deste cliente
            $stmt = $pdo->prepare("DELETE FROM prazos WHERE usuario_id = ? AND processo_id IN (SELECT id FROM processos WHERE cliente_id = ? AND usuario_id = ?)");
            $stmt->execute([$_SESSION["user_id"], $id, $_SESSION["user_id"]]);
            
            // Excluir documentos deste cliente
            $stmt = $pdo->prepare("DELETE FROM documentos WHERE cliente_id = ? AND usuario_id = ?");
            $stmt->execute([$id, $_SESSION["user_id"]]);
            
            // Excluir financeiro deste cliente
            $stmt = $pdo->prepare("DELETE FROM financeiro WHERE cliente_id = ? AND usuario_id = ?");
            $stmt->execute([$id, $_SESSION["user_id"]]);
            
            // Excluir processos deste cliente
            $stmt = $pdo->prepare("DELETE FROM processos WHERE cliente_id = ? AND usuario_id = ?");
            $stmt->execute([$id, $_SESSION["user_id"]]);
            
            // Excluir o próprio cliente
            $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ? AND usuario_id = ?");
            $stmt->execute([$id, $_SESSION["user_id"]]);
            
            $_SESSION['flash_msg'] = "Cliente e todos os seus registros vinculados foram removidos com sucesso!";
        } catch (PDOException $e) {
            $_SESSION['flash_err'] = "Erro ao remover cliente: " . $e->getMessage();
=======
            $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ? AND usuario_id = ?");
            $stmt->execute([$id, $_SESSION["user_id"]]);
            $_SESSION['flash_msg'] = "Cliente removido com sucesso!";
        } catch (PDOException $e) {
            $_SESSION['flash_err'] = "Erro: Não é possível remover este cliente pois há processos, prazos ou documentos vinculados a ele.";
>>>>>>> bd18950110dbebd2dc03d6cf49fac0958c0e65ec
        }
        redirect('/clientes');
    }
}