<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação em 2 Passos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .login-card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 400px; padding: 20px; background: #fff; }
    </style>
</head>
<body>

<div class="login-card">
    <h4 class="text-center mb-4">Verificação 2FA</h4>
    
    <?php if (isset($_SESSION['2fa_flash_message'])): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($_SESSION['2fa_flash_message']) ?>
            <?php unset($_SESSION['2fa_flash_message']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <form method="POST" action="<?= BASE_URL ?>/login/2fa">
        <div class="mb-3">
            <label class="form-label">Código recebido no e-mail</label>
            <input type="text" name="codigo" class="form-control" required autofocus autocomplete="off" placeholder="Ex: 123456">
        </div>
        <button type="submit" class="btn btn-success w-100">Verificar Código</button>
    </form>
</div>

</body>
</html>
