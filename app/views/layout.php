<?php global $path; if(!isset($path)) $path = 'dashboard'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão Advogados - Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background-color: #2c3e50; color: white; padding-top: 20px; }
        .sidebar a { color: #bdc3c7; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover, .sidebar a.active { color: white; background-color: #34495e; }
        .content { padding: 20px; }
        .navbar-top { background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05); padding: 15px 20px; margin-bottom: 20px; border-radius: 8px; }
    </style>

    <link rel="shortcut icon" type="image/jpeg" href="<?= BASE_URL ?>/favicon.jpg?v=1789605784">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar d-none d-md-block">
            <h4 class="text-center mb-4"> Gestão Advogados</h4>
            <a href="<?= BASE_URL ?>/dashboard" class="<?= $path == '/dashboard' || $path == '/' ? 'active' : '' ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
            <a href="<?= BASE_URL ?>/clientes" class="<?= strpos($path, '/clientes') === 0 ? 'active' : '' ?>"><i class="bi bi-people me-2"></i> Clientes</a>
            <a href="<?= BASE_URL ?>/processos" class="<?= strpos($path, '/processos') === 0 ? 'active' : '' ?>"><i class="bi bi-folder2-open me-2"></i> Processos</a>
            <a href="<?= BASE_URL ?>/prazos" class="<?= strpos($path, '/prazos') === 0 ? 'active' : '' ?>"><i class="bi bi-calendar-event me-2"></i> Agenda de Prazos</a>
            <a href="<?= BASE_URL ?>/financeiro" class="<?= strpos($path, '/financeiro') === 0 ? 'active' : '' ?>"><i class="bi bi-currency-dollar me-2"></i> Financeiro</a>
            <a href="<?= BASE_URL ?>/documentos" class="<?= strpos($path, '/documentos') === 0 ? 'active' : '' ?>"><i class="bi bi-file-earmark-text me-2"></i> Documentos</a>
            <hr class="border-secondary">
            <a href="<?= BASE_URL ?>/logout" class="text-danger"><i class="bi bi-box-arrow-right me-2"></i> Sair</a>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10 content">
            <div class="d-flex justify-content-between align-items-center navbar-top">
                <h5 class="m-0 text-muted">Bem-vindo, <?= htmlspecialchars($_SESSION['email']) ?></h5>
                <span class="badge bg-success">Online</span>
            </div>
            
            <?php if (isset($_SESSION['flash_msg'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['flash_msg']) ?>
                    <?php if(isset($_SESSION['whatsapp_url'])): ?>
                        <br><br>
                        <a href="<?= $_SESSION['whatsapp_url'] ?>" target="_blank" class="btn btn-success">
                            <i class="bi bi-whatsapp"></i> Enviar Mensagem no WhatsApp
                        </a>
                        <?php unset($_SESSION['whatsapp_url']); ?>
                    <?php endif; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['flash_msg']); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['flash_err'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['flash_err']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['flash_err']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($content)) require $content; ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>