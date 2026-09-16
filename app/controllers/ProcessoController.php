<?php
class ProcessoController {
    public function index() {
        $pdo = getDB();
        $processos = $pdo->query("
            SELECT p.*, c.nome as cliente_nome 
            FROM processos p 
            JOIN clientes c ON p.cliente_id = c.id 
            ORDER BY p.id DESC
        ")->fetchAll();
        $content = 'app/views/processos/index.php';
        require 'app/views/layout.php';
    }

    public function create() {
        $pdo = getDB();
        $clientes = $pdo->query("SELECT id, nome FROM clientes ORDER BY nome ASC")->fetchAll();
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
            $stmt = $pdo->prepare("INSERT INTO processos (cliente_id, numero_processo, tribunal, vara, parte_contraria, status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$cliente_id, $numero_processo, $tribunal, $vara, $parte_contraria, $status]);
            
            $_SESSION['flash_msg'] = "Processo cadastrado com sucesso!";
            redirect('/processos');
        } catch (PDOException $e) {
            // Verificar se o erro foi por conta da restrição UNIQUE no numero_processo
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
        $stmt = $pdo->prepare("SELECT * FROM processos WHERE id = ?");
        $stmt->execute([$id]);
        $processo = $stmt->fetch();
        
        if (!$processo) {
            $_SESSION['flash_err'] = "Processo não encontrado.";
            redirect('/processos');
        }
        
        $content = 'app/views/processos/edit.php';
        require 'app/views/layout.php';
    }
    
    public function update($id) {
        $status = $_POST['status'] ?? '';
        $andamento = $_POST['andamento_resumido'] ?? '';
        
        $pdo = getDB();
        
        // Pega andamento antigo para ver se mudou
        $stmt = $pdo->prepare("SELECT p.andamento_resumido, c.telefone, c.nome, p.numero_processo FROM processos p JOIN clientes c ON p.cliente_id = c.id WHERE p.id = ?");
        $stmt->execute([$id]);
        $dadosAntigos = $stmt->fetch();
        
        $stmt = $pdo->prepare("UPDATE processos SET status = ?, andamento_resumido = ? WHERE id = ?");
        $stmt->execute([$status, $andamento, $id]);
        
        // Disparar WhatsApp se o andamento mudou
        if ($dadosAntigos && $dadosAntigos['andamento_resumido'] !== $andamento) {
            $this->enviarWhatsApp($dadosAntigos['telefone'], $dadosAntigos['nome'], $dadosAntigos['numero_processo'], $andamento);
            $_SESSION['flash_msg'] = "Processo atualizado e cliente notificado via WhatsApp!";
        } else {
            $_SESSION['flash_msg'] = "Processo atualizado com sucesso!";
        }
        
        redirect('/processos');
    }
    
    private function enviarWhatsApp($telefone, $nome, $numeroProcesso, $andamento) {
        // Simulação do disparo usando WhatsApp Cloud API
        $token = 'SEU_TOKEN_AQUI'; // Viria do .env
        $phoneId = 'SEU_PHONE_ID'; // Viria do .env
        
        $mensagem = "Olá $nome! Há um novo andamento no seu processo (Nº $numeroProcesso): $andamento";
        
        /* 
        Exemplo real de cURL:
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v17.0/$phoneId/messages");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $token",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "messaging_product" => "whatsapp",
            "to" => $telefone,
            "type" => "text",
            "text" => ["body" => $mensagem]
        ]));
        $response = curl_exec($ch);
        curl_close($ch);
        */
        
        // Estamos simulando escrevendo no log (para não quebrar a aplicação sem token)
        error_log("WHATSAPP ENVIADO PARA $telefone: $mensagem");
    }
}
