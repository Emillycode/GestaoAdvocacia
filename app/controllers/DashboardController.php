<?php
// app/controllers/DashboardController.php

class DashboardController {
    public function index() {
        $pdo = getDB();
        
        // Obter estatísticas rápidas
        $stmt_cli = $pdo->prepare("SELECT COUNT(*) FROM clientes WHERE usuario_id = ?"); $stmt_cli->execute([$_SESSION["user_id"]]); $clientesCount = $stmt_cli->fetchColumn();
<<<<<<< HEAD
        $stmt_proc = $pdo->prepare("SELECT COUNT(*) FROM processos WHERE usuario_id = ? AND status = 'Ativo'"); $stmt_proc->execute([$_SESSION["user_id"]]); $processosCount = $stmt_proc->fetchColumn();
=======
        $stmt_proc = $pdo->prepare("SELECT COUNT(*) FROM processos WHERE usuario_id = ?"); $stmt_proc->execute([$_SESSION["user_id"]]); $processosCount = $stmt_proc->fetchColumn();
>>>>>>> bd18950110dbebd2dc03d6cf49fac0958c0e65ec
        
        // Prazos para os próximos 7 dias
        $stmt = $pdo->prepare("SELECT * FROM prazos WHERE concluido = 0 AND usuario_id = ? AND data_vencimento BETWEEN date('now') AND date('now', '+7 days') ORDER BY data_vencimento ASC");
        $stmt->execute([$_SESSION["user_id"]]);
        $prazosProximos = $stmt->fetchAll();
        
        $content = 'app/views/dashboard.php';
        require 'app/views/layout.php';
    }
}
