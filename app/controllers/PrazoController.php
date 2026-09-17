<?php
class PrazoController {
    public function index() {
        $pdo = getDB();
        $stmt = $pdo->prepare("
            SELECT p.*, pr.numero_processo 
            FROM prazos p 
<<<<<<< HEAD
            LEFT JOIN processos pr ON p.processo_id = pr.id 
=======
            JOIN processos pr ON p.processo_id = pr.id 
>>>>>>> bd18950110dbebd2dc03d6cf49fac0958c0e65ec
            WHERE p.usuario_id = ? 
            ORDER BY p.concluido ASC, p.data_vencimento ASC
        "); $stmt->execute([$_SESSION["user_id"]]); $prazos = $stmt->fetchAll();
        
        $content = 'app/views/prazos/index.php';
        require 'app/views/layout.php';
    }

    public function create() {
        $pdo = getDB();
        $stmt_p = $pdo->prepare("SELECT id, numero_processo FROM processos WHERE usuario_id = ? ORDER BY id DESC"); $stmt_p->execute([$_SESSION["user_id"]]); $processos = $stmt_p->fetchAll();
        $content = 'app/views/prazos/form.php';
        require 'app/views/layout.php';
    }

    public function store() {
        $processo_id = $_POST['processo_id'] ?? null;
        $titulo = $_POST['titulo'] ?? '';
        $data_vencimento = $_POST['data_vencimento'] ?? '';
        $tipo = $_POST['tipo'] ?? 'Prazo Fatal';

        $pdo = getDB();
        $stmt = $pdo->prepare("INSERT INTO prazos (processo_id, titulo, data_vencimento, tipo, usuario_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$processo_id, $titulo, $data_vencimento, $tipo, $_SESSION["user_id"]]);
        
        $_SESSION['flash_msg'] = "Prazo/Audiência cadastrado com sucesso!";
        redirect('/prazos');
    }
    
    public function concluir($id) {
        $pdo = getDB();
        $stmt = $pdo->prepare("UPDATE prazos SET concluido = 1 WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$id, $_SESSION["user_id"]]);
        
        $_SESSION['flash_msg'] = "Prazo marcado como concluído!";
        redirect('/prazos');
    }

    public function edit($id) {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM prazos WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$id, $_SESSION["user_id"]]);
        $prazo = $stmt->fetch();
        if (!$prazo) {
            $_SESSION['flash_err'] = "Prazo não encontrado.";
            redirect('/prazos');
        }
        
        $stmt_p = $pdo->prepare("SELECT id, numero_processo FROM processos WHERE usuario_id = ? ORDER BY id DESC"); $stmt_p->execute([$_SESSION["user_id"]]); $processos = $stmt_p->fetchAll();
        $content = 'app/views/prazos/edit.php';
        require 'app/views/layout.php';
    }

    public function update($id) {
        $processo_id = $_POST['processo_id'] ?? null;
        $titulo = $_POST['titulo'] ?? '';
        $data_vencimento = $_POST['data_vencimento'] ?? '';
        $tipo = $_POST['tipo'] ?? 'Prazo Fatal';

        $pdo = getDB();
        $stmt = $pdo->prepare("UPDATE prazos SET processo_id=?, titulo=?, data_vencimento=?, tipo=? WHERE id=? AND usuario_id=?");
        $stmt->execute([$processo_id, $titulo, $data_vencimento, $tipo, $id, $_SESSION["user_id"]]);
        
        $_SESSION['flash_msg'] = "Prazo atualizado com sucesso!";
        redirect('/prazos');
    }

    public function delete($id) {
        $pdo = getDB();
        $stmt = $pdo->prepare("DELETE FROM prazos WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$id, $_SESSION["user_id"]]);
        $_SESSION['flash_msg'] = "Prazo removido com sucesso!";
        redirect('/prazos');
    }
}

