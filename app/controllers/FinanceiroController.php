<?php
class FinanceiroController {
    public function index() {
        $pdo = getDB();
        
        $mes_atual = $_GET['mes'] ?? date('Y-m');
        
        $stmt = $pdo->prepare("
            SELECT f.*, c.nome as cliente_nome 
            FROM financeiro f 
            LEFT JOIN clientes c ON f.cliente_id = c.id 
            WHERE f.mes_referencia = ? AND f.usuario_id = ?
            ORDER BY f.data_lancamento DESC
        ");
        $stmt->execute([$mes_atual, $_SESSION["user_id"]]);
        $lancamentos = $stmt->fetchAll();
        
        // Calcular totais
        $totalHonorarios = 0;
        $totalClientes = 0; // Indenização + Custas (Dinheiro do Cliente)
        
        foreach ($lancamentos as $lan) {
            if ($lan['tipo_lancamento'] == 'Honorários') {
                $totalHonorarios += $lan['valor'];
            } else {
                $totalClientes += $lan['valor'];
            }
        }
        
        $content = 'app/views/financeiro/index.php';
        require 'app/views/layout.php';
    }

    public function create() {
        $pdo = getDB();
        $stmt_c = $pdo->prepare("SELECT id, nome FROM clientes WHERE usuario_id = ? ORDER BY nome ASC"); $stmt_c->execute([$_SESSION["user_id"]]); $clientes = $stmt_c->fetchAll();
        $content = 'app/views/financeiro/form.php';
        require 'app/views/layout.php';
    }

    public function store() {
        $cliente_id = !empty($_POST['cliente_id']) ? $_POST['cliente_id'] : null;
        $tipo_lancamento = $_POST['tipo_lancamento'] ?? 'Honorários';
        $valor = $_POST['valor'] ?? 0;
        $data_lancamento = $_POST['data_lancamento'] ?? date('Y-m-d');
        $descricao = $_POST['descricao'] ?? '';
        
        // Pega o Y-m da data para o mês referência
        $mes_referencia = substr($data_lancamento, 0, 7);

        $pdo = getDB();
        $stmt = $pdo->prepare("INSERT INTO financeiro (cliente_id, tipo_lancamento, valor, data_lancamento, mes_referencia, descricao, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$cliente_id, $tipo_lancamento, $valor, $data_lancamento, $mes_referencia, $descricao, $_SESSION["user_id"]]);
        
        $_SESSION['flash_msg'] = "Lançamento adicionado com sucesso!";
        redirect('/financeiro?mes=' . $mes_referencia);
    }
}
