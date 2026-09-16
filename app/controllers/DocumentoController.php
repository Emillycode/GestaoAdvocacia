<?php
class DocumentoController {
    public function index() {
        $pdo = getDB();
        
        $stmt = $pdo->query("
            SELECT d.*, c.nome as cliente_nome, p.numero_processo 
            FROM documentos d 
            JOIN clientes c ON d.cliente_id = c.id 
            LEFT JOIN processos p ON d.processo_id = p.id
            ORDER BY d.created_at DESC
        ");
        $documentos = $stmt->fetchAll();
        
        $content = 'app/views/documentos/index.php';
        require 'app/views/layout.php';
    }

    public function create() {
        $pdo = getDB();
        $clientes = $pdo->query("SELECT id, nome FROM clientes ORDER BY nome ASC")->fetchAll();
        $processos = $pdo->query("SELECT id, numero_processo FROM processos ORDER BY numero_processo ASC")->fetchAll();
        
        $content = 'app/views/documentos/form.php';
        require 'app/views/layout.php';
    }

    public function store() {
        $cliente_id = $_POST['cliente_id'] ?? null;
        $processo_id = !empty($_POST['processo_id']) ? $_POST['processo_id'] : null;
        $tipo_documento = $_POST['tipo_documento'] ?? '';
        
        if (!isset($_FILES['arquivo']) || $_FILES['arquivo']['error'] != 0) {
            $_SESSION['flash_err'] = "Erro ao fazer upload do arquivo.";
            redirect('/documentos/novo');
            return;
        }
        
        $arquivo = $_FILES['arquivo'];
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $nome_original = $arquivo['name'];
        $novo_nome = uniqid() . '.' . $extensao;
        $caminho = 'public/uploads/' . $novo_nome;
        
        if (move_uploaded_file($arquivo['tmp_name'], __DIR__ . '/../../' . $caminho)) {
            $pdo = getDB();
            $stmt = $pdo->prepare("INSERT INTO documentos (cliente_id, processo_id, nome_arquivo, caminho_arquivo, tipo_documento) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$cliente_id, $processo_id, $nome_original, $caminho, $tipo_documento]);
            
            $_SESSION['flash_msg'] = "Documento salvo com sucesso!";
            redirect('/documentos');
        } else {
            $_SESSION['flash_err'] = "Falha ao mover arquivo para pasta de uploads.";
            redirect('/documentos/novo');
        }
    }
}
