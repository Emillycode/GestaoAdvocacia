<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Verificação em 2 Passos - Gestão Advogados</title>
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
        .brand-icon {
            width: 56px;
            height: 56px;
            background: #10b981;
            color: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 16px auto;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
        }
        .form-control {
            font-size: 1.25rem;
            letter-spacing: 4px;
            text-align: center;
            font-weight: 700;
            padding: 12px;
            border-radius: 8px;
        }
        .btn-success {
            padding: 12px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
        }
    </style>
    <link rel="shortcut icon" type="image/jpeg" href="<?= BASE_URL ?>/favicon.jpg?v=1789605784">
</head>
<body>

<div class="login-card">
    <div class="brand-icon">
        <i class="bi bi-shield-check"></i>
    </div>
    <h4 class="text-center fw-bold mb-1 text-dark">Verificação em 2 Etapas</h4>
    <p class="text-center text-muted small mb-4">Insira o código de 6 dígitos enviado para você</p>
    
    <?php if (isset($_SESSION['2fa_flash_message'])): ?>
        <div class="alert alert-info py-2 small">
            <i class="bi bi-info-circle me-1"></i> <?= htmlspecialchars($_SESSION['2fa_flash_message']) ?>
            <?php unset($_SESSION['2fa_flash_message']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger py-2 small">
            <i class="bi bi-x-circle me-1"></i> <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="<?= BASE_URL ?>/login/2fa">
        <div class="mb-4">
            <input type="text" name="codigo" class="form-control" required autofocus autocomplete="off" placeholder="000000" maxlength="6" inputmode="numeric">
        </div>
        <button type="submit" class="btn btn-success w-100 shadow-sm mb-3">
            <i class="bi bi-check2-circle me-1"></i> Confirmar e Entrar
        </button>
        <div class="text-center">
            <a href="<?= BASE_URL ?>/login" class="text-muted small text-decoration-none">
                <i class="bi bi-arrow-left"></i> Voltar para o Login
            </a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>