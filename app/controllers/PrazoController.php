<?php
class PrazoController {
    public function index() {
        $pdo = getDB();
        $prazos = $pdo->query("
            SELECT p.*, pr.numero_processo 
            FROM prazos p 
            JOIN processos pr ON p.processo_id = pr.id 
            ORDER BY p.concluido ASC, p.data_vencimento ASC
        ")->fetchAll();
        
        $content = 'app/views/prazos/index.php';
        require 'app/views/layout.php';
    }

    public function create() {
        $pdo = getDB();
        $processos = $pdo->query("SELECT id, numero_processo FROM processos ORDER BY id DESC")->fetchAll();
        $content = 'app/views/prazos/form.php';
        require 'app/views/layout.php';
    }

    public function store() {
        $processo_id = $_POST['processo_id'] ?? null;
        $titulo = $_POST['titulo'] ?? '';
        $data_vencimento = $_POST['data_vencimento'] ?? '';
        $tipo = $_POST['tipo'] ?? 'Prazo Fatal';

        $pdo = getDB();
        $stmt = $pdo->prepare("INSERT INTO prazos (processo_id, titulo, data_vencimento, tipo) VALUES (?, ?, ?, ?)");
        $stmt->execute([$processo_id, $titulo, $data_vencimento, $tipo]);
        
        $_SESSION['flash_msg'] = "Prazo/Audiência cadastrado com sucesso!";
        redirect('/prazos');
    }
    
    public function concluir($id) {
        $pdo = getDB();
        $stmt = $pdo->prepare("UPDATE prazos SET concluido = 1 WHERE id = ?");
        $stmt->execute([$id]);
        
        $_SESSION['flash_msg'] = "Prazo marcado como concluído!";
        redirect('/prazos');
    }
}
