<?php
class ProcessoController {
    public function index() {
        $pdo = getDB();
        $stmt = $pdo->prepare("
            SELECT p.*, c.nome as cliente_nome 
            FROM processos p 
            LEFT JOIN clientes c ON p.cliente_id = c.id 
            WHERE p.usuario_id = ?
            ORDER BY p.id DESC
        "); $stmt->execute([$_SESSION["user_id"]]); $processos = $stmt->fetchAll();
        $content = 'app/views/processos/index.php';
        require 'app/views/layout.php';
    }

    public function create() {
        $pdo = getDB();
        $stmt_c = $pdo->prepare("SELECT id, nome FROM clientes WHERE usuario_id = ? ORDER BY nome ASC"); 
        $stmt_c->execute([$_SESSION["user_id"]]); 
        $clientes = $stmt_c->fetchAll();
        $content = 'app/views/processos/form.php';
        require 'app/views/layout.php';
    }

    public function store() {
        $cliente_id = $_POST['cliente_id'] ?? null;
        $numero_processo = $_POST['numero_processo'] ?? '';
        $tribunal = $_POST['tribunal'] ?? '';
        $vara = $_POST['vara'] ?? '';
        $parte_contraria = $_POST['parte_contraria'] ?? '';
        $status = $_POST['status'] ?? 'Ativo';

        $pdo = getDB();
        
        try {
            $stmt = $pdo->prepare("INSERT INTO processos (cliente_id, numero_processo, tribunal, vara, parte_contraria, status, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$cliente_id, $numero_processo, $tribunal, $vara, $parte_contraria, $status, $_SESSION["user_id"]]);
            
            $_SESSION['flash_msg'] = "Processo cadastrado com sucesso!";
            redirect('/processos');
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'UNIQUE constraint failed') !== false) {
                $_SESSION['flash_err'] = "Erro: Já existe um processo com este número!";
            } else {
                $_SESSION['flash_err'] = "Erro ao cadastrar processo: " . $e->getMessage();
            }
            redirect('/processos/novo');
        }
    }
    
    public function edit($id) {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM processos WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$id, $_SESSION["user_id"]]);
        $processo = $stmt->fetch();
        
        if (!$processo) {
            $_SESSION['flash_err'] = "Processo não encontrado.";
            redirect('/processos');
        }
        
        $stmt_c = $pdo->prepare("SELECT id, nome FROM clientes WHERE usuario_id = ? ORDER BY nome ASC");
        $stmt_c->execute([$_SESSION["user_id"]]);
        $clientes = $stmt_c->fetchAll();
        
        $content = 'app/views/processos/edit.php';
        require 'app/views/layout.php';
    }
    
    public function update($id) {
        $cliente_id = $_POST['cliente_id'] ?? null;
        $numero_processo = $_POST['numero_processo'] ?? '';
        $parte_contraria = $_POST['parte_contraria'] ?? '';
        $tribunal = $_POST['tribunal'] ?? '';
        $vara = $_POST['vara'] ?? '';
        $status = $_POST['status'] ?? '';
        $andamento = $_POST['andamento_resumido'] ?? '';
        
        $pdo = getDB();
        
        $stmt = $pdo->prepare("SELECT p.andamento_resumido, c.telefone, c.nome, p.numero_processo FROM processos p LEFT JOIN clientes c ON p.cliente_id = c.id WHERE p.id = ? AND p.usuario_id = ?");
        $stmt->execute([$id, $_SESSION["user_id"]]);
        $dadosAntigos = $stmt->fetch();
        
        try {
            $stmt = $pdo->prepare("UPDATE processos SET cliente_id = ?, numero_processo = ?, parte_contraria = ?, tribunal = ?, vara = ?, status = ?, andamento_resumido = ? WHERE id = ? AND usuario_id = ?");
            $stmt->execute([$cliente_id, $numero_processo, $parte_contraria, $tribunal, $vara, $status, $andamento, $id, $_SESSION["user_id"]]);
            
            if ($dadosAntigos && !empty($dadosAntigos['telefone']) && trim($andamento) !== '' && $dadosAntigos['andamento_resumido'] !== $andamento) {
                $telefone = preg_replace('/[^0-9]/', '', $dadosAntigos['telefone']);
                $nome = $dadosAntigos['nome'] ?? 'Cliente';
                $numeroProcesso = $dadosAntigos['numero_processo'];
                
                $texto = "Olá, $nome! Tem um novo andamento no seu processo (N $numeroProcesso):\n\n*$andamento*";
                $url = "https://wa.me/{$telefone}?text=" . urlencode($texto);
                
                $_SESSION['whatsapp_url'] = $url;
                $_SESSION['flash_msg'] = "Processo atualizado! Clique no botão abaixo para avisar o cliente.";
            } else {
                $_SESSION['flash_msg'] = "Processo atualizado com sucesso!";
            }
        } catch (PDOException $e) {
            $_SESSION['flash_err'] = "Erro ao atualizar. Numero de processo já existe.";
        }
        
        redirect('/processos');
    }
    
    public function delete($id) {
        $pdo = getDB();
        // Excluir prazos e documentos vinculados a este processo
        $stmt_prz = $pdo->prepare("DELETE FROM prazos WHERE processo_id = ? AND usuario_id = ?");
        $stmt_prz->execute([$id, $_SESSION["user_id"]]);
        $stmt_doc = $pdo->prepare("DELETE FROM documentos WHERE processo_id = ? AND usuario_id = ?");
        $stmt_doc->execute([$id, $_SESSION["user_id"]]);
        
        $stmt = $pdo->prepare("DELETE FROM processos WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$id, $_SESSION["user_id"]]);
        $_SESSION['flash_msg'] = "Processo e registros vinculados excluídos com sucesso!";
        redirect('/processos');
    }
}
