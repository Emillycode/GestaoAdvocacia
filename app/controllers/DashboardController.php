<?php
// app/controllers/DashboardController.php

class DashboardController {
    public function index() {
        $pdo = getDB();
        
        // Obter estatísticas rápidas
        $clientesCount = $pdo->query("SELECT COUNT(*) FROM clientes")->fetchColumn();
        $processosCount = $pdo->query("SELECT COUNT(*) FROM processos")->fetchColumn();
        
        // Prazos para os próximos 7 dias
        $stmt = $pdo->prepare("SELECT * FROM prazos WHERE concluido = 0 AND data_vencimento BETWEEN date('now') AND date('now', '+7 days') ORDER BY data_vencimento ASC");
        $stmt->execute();
        $prazosProximos = $stmt->fetchAll();
        
        $content = 'app/views/dashboard.php';
        require 'app/views/layout.php';
    }
}
