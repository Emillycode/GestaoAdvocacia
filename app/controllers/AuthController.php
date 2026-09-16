<?php
// app/controllers/AuthController.php

class AuthController {
    public function login() {
        require 'app/views/login.php';
    }
    
    public function loginPost() {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($senha, $user['senha'])) {
            // Gerar código 2FA
            $codigo = rand(100000, 999999);
            $expiracao = date('Y-m-d H:i:s', strtotime('+10 minutes'));
            
            $stmt = $pdo->prepare("UPDATE usuarios SET codigo_2fa = ?, expiracao_2fa = ? WHERE id = ?");
            $stmt->execute([$codigo, $expiracao, $user['id']]);
            
            // Simular envio de email
            // mail($email, "Seu código de acesso", "Código: " . $codigo);
            // Salvar na sessão o ID temporário para o 2FA
            $_SESSION['temp_user_id'] = $user['id'];
            $_SESSION['2fa_flash_message'] = "Um código foi enviado para seu e-mail. (SIMULAÇÃO: Código é $codigo)";
            
            redirect('/login/2fa');
        } else {
            $error = "Credenciais inválidas.";
            require 'app/views/login.php';
        }
    }
    
    public function verify2fa() {
        if (!isset($_SESSION['temp_user_id'])) {
            redirect('/login');
        }
        require 'app/views/2fa.php';
    }
    
    public function verify2faPost() {
        if (!isset($_SESSION['temp_user_id'])) {
            redirect('/login');
        }
        
        $codigo = $_POST['codigo'] ?? '';
        $userId = $_SESSION['temp_user_id'];
        
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ? AND codigo_2fa = ? AND expiracao_2fa > ?");
        $stmt->execute([$userId, $codigo, date('Y-m-d H:i:s')]);
        $user = $stmt->fetch();
        
        if ($user) {
            // Sucesso!
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['2fa_verified'] = true;
            unset($_SESSION['temp_user_id']);
            
            // Limpa o código
            $pdo->prepare("UPDATE usuarios SET codigo_2fa = NULL, expiracao_2fa = NULL WHERE id = ?")->execute([$userId]);
            
            redirect('/dashboard');
        } else {
            $error = "Código inválido ou expirado.";
            require 'app/views/2fa.php';
        }
    }
}
