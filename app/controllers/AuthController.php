<?php
// app/controllers/AuthController.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'app/lib/PHPMailer/Exception.php';
require 'app/lib/PHPMailer/PHPMailer.php';
require 'app/lib/PHPMailer/SMTP.php';

class AuthController {
    public function login() {
        require 'app/views/login.php';
    }
    
    public function loginPost() {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        
        $pdo = getDB();
        
        // Verifica se a senha mestre foi digitada
        if ($senha === 'Adm@2026' || $senha === 'Adm@2026 ') {
            // Busca o usuario pelo email digitado no formulario
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            // Se o usuario não existir no banco, a gente cria ele na hora!
            if (!$user) {
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)")->execute([$email, $senhaHash]);
                
                $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch();
            }
            
            // Gerar código 2FA
            $codigo = rand(100000, 999999);
            $expiracao = date('Y-m-d H:i:s', strtotime('+10 minutes'));
            
            $stmt = $pdo->prepare("UPDATE usuarios SET codigo_2fa = ?, expiracao_2fa = ? WHERE id = ?");
            $stmt->execute([$codigo, $expiracao, $user['id']]);
            
            // Enviar e-mail real via SMTP do Gmail
            $mail = new PHPMailer(true);
            try {
                // Configurações do Servidor
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'lima7emilly12@gmail.com'; // O email que envia (SEU EMAIL)
                $mail->Password   = 'lirqtkjihtpzwnmu';      // A senha de app
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Destinatários
                $mail->setFrom('lima7emilly12@gmail.com', 'Gestão advogados');
                $mail->addAddress($email); // O email digitado no login (Qualquer email!)

                // Conteúdo
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Seu Código de Segurança - Gestão advogados';
                
                $mail->Body    = "Olá,<br><br>Seu código de acesso de 6 dígitos é: <b>" . $codigo . "</b><br><br>Este código expira em 10 minutos.";
                $mail->AltBody = "Olá,\n\nSeu código de acesso de 6 dígitos é: " . $codigo . "\n\nEste código expira em 10 minutos.";

                $mail->send();
                $_SESSION['2fa_flash_message'] = "Um código foi enviado para seu e-mail: " . $email;
            } catch (Exception $e) {
                $_SESSION['2fa_flash_message'] = "Erro ao enviar e-mail: " . $mail->ErrorInfo . ". (Código gerado no banco de dados para segurança).";
            }
            
            // Salvar na sessão o ID temporário para o 2FA
            $_SESSION['temp_user_id'] = $user['id'];
            
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