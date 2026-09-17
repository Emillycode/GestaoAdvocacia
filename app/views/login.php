<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Login - Gestão Advogados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { 
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            display: flex; 
            align-items: center; 
            justify-content: center; 
            min-height: 100vh; 
            padding: 20px 16px;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
        .login-card { 
            border: none; 
            border-radius: 16px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.25); 
            width: 100%; 
            max-width: 420px; 
            padding: 32px 28px; 
            background: #ffffff; 
        }
        .login-brand-icon {
            width: 56px;
            height: 56px;
            background: #0284c7;
            color: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 16px auto;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.35);
        }
        .password-toggle { 
            cursor: pointer; 
        }
        .form-control {
            font-size: 1rem;
            padding: 10px 14px;
            border-radius: 8px;
        }
        .btn-primary {
            padding: 12px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            background-color: #0284c7;
            border-color: #0284c7;
        }
        .btn-primary:hover {
            background-color: #0369a1;
            border-color: #0369a1;
        }
    </style>

    <link rel="shortcut icon" type="image/jpeg" href="<?= BASE_URL ?>/favicon.jpg?v=1789605784">
</head>
<body>

<div class="login-card">
    <div class="login-brand-icon">
        <i class="bi bi-shield-lock"></i>
    </div>
    <h4 class="text-center fw-bold mb-1 text-dark">Gestão Advogados</h4>
    <p class="text-center text-muted small mb-4">Acesse sua conta jurídica</p>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-1"></i> <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="<?= BASE_URL ?>/login">
        <div class="mb-3">
            <label class="form-label fw-semibold small text-secondary">E-mail Corporativo</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" required autofocus placeholder="seuemail@adv.com" value="">
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold small text-secondary">Senha de Acesso</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-key"></i></span>
                <input type="password" name="senha" id="senha" class="form-control" required value="Adm@2026">
                <span class="input-group-text bg-light password-toggle" onclick="togglePassword()" title="Mostrar/Ocultar Senha">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                </span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 shadow-sm">
            <i class="bi bi-box-arrow-in-right me-1"></i> Entrar no Sistema
        </button>
    </form>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('senha');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>