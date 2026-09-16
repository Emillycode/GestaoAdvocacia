<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LexGestão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .login-card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 400px; padding: 20px; background: #fff; }
    </style>
</head>
<body>

<div class="login-card">
    <h3 class="text-center mb-4"> Gestão Advogados</h3>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <form method="POST" action="<?= BASE_URL ?>/login">
        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" required autofocus value="admin@escritorio.com">
        </div>
        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" required value="Adm@2026">
        </div>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>
</div>

</body>
</html>
