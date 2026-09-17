<?php global $path; if(!isset($path)) $path = '/dashboard'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Gestão Advogados - Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #0284c7;
            --primary-accent: #0284c7;
        }
        body { 
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; 
            background-color: #f1f5f9; 
            color: #1e293b;
            min-height: 100vh;
        }

        /* Desktop Sidebar */
        .sidebar { 
            min-height: 100vh; 
            background-color: var(--sidebar-bg); 
            color: white; 
            padding: 24px 16px; 
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }
        .sidebar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
            padding: 0 12px 20px 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        .sidebar-brand img {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            object-fit: cover;
        }
        .sidebar a, .offcanvas a.nav-link-custom { 
            color: #94a3b8; 
            text-decoration: none; 
            display: flex; 
            align-items: center;
            padding: 12px 14px; 
            border-radius: 8px;
            margin-bottom: 4px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .sidebar a:hover, .offcanvas a.nav-link-custom:hover { 
            color: #fff; 
            background-color: var(--sidebar-hover); 
        }
        .sidebar a.active, .offcanvas a.nav-link-custom.active { 
            color: white; 
            background-color: var(--sidebar-active); 
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
        }

        /* Top Bar */
        .navbar-top { 
            background-color: white; 
            box-shadow: 0 1px 3px rgba(0,0,0,0.05); 
            padding: 14px 20px; 
            margin-bottom: 20px; 
            border-radius: 12px; 
        }
        .content { 
            padding: 24px 28px; 
        }

        /* Mobile Header */
        .mobile-header {
            background-color: var(--sidebar-bg);
            color: white;
            padding: 12px 16px;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .mobile-header .brand-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .mobile-header .btn-toggle-menu {
            color: #fff;
            background: rgba(255,255,255,0.1);
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 1.3rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Mobile Bottom Nav Bar (Quick access like native apps) */
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 6px 0 8px 0;
            z-index: 1040;
            border-top: 1px solid #e2e8f0;
        }
        .mobile-bottom-nav a {
            color: #64748b;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.72rem;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 8px;
            transition: all 0.15s ease;
        }
        .mobile-bottom-nav a i {
            font-size: 1.25rem;
            margin-bottom: 2px;
        }
        .mobile-bottom-nav a.active {
            color: var(--primary-accent);
            font-weight: 700;
        }

        /* Offcanvas styling */
        .offcanvas-sidebar {
            background-color: var(--sidebar-bg);
            color: white;
            width: 280px !important;
        }

        /* Cards & tables responsive polish */
        .card {
            border-radius: 12px;
            border: 1px solid rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .table-responsive {
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
        }
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #64748b;
            white-space: nowrap;
        }
        .table td {
            vertical-align: middle;
        }
        .btn-sm {
            padding: 0.35rem 0.65rem;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        /* Mobile specific spacing */
        @media (max-width: 767.98px) {
            .content {
                padding: 14px 12px 85px 12px; /* Extra bottom padding for mobile bar */
            }
            .navbar-top {
                padding: 12px 14px;
                margin-bottom: 15px;
                border-radius: 10px;
            }
            h2 {
                font-size: 1.4rem;
            }
            .page-header-responsive {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 12px;
            }
            .page-header-responsive .btn {
                width: 100%;
            }
        }
    </style>

    <link rel="shortcut icon" type="image/jpeg" href="<?= BASE_URL ?>/favicon.jpg?v=1789605784">
</head>
<body>

<!-- Mobile Header (Visible only on mobile/tablet) -->
<div class="mobile-header d-flex justify-content-between align-items-center d-md-none">
    <a href="<?= BASE_URL ?>/dashboard" class="brand-title">
        <img src="<?= BASE_URL ?>/favicon.jpg?v=1789605784" width="28" height="28" style="border-radius: 6px; object-fit: cover;" onerror="this.style.display='none'">
        <span>Gestão Advogados</span>
    </a>
    <button class="btn-toggle-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar" aria-label="Abrir Menu">
        <i class="bi bi-list"></i>
    </button>
</div>

<!-- Mobile Offcanvas Menu (Drawer) -->
<div class="offcanvas offcanvas-start offcanvas-sidebar d-md-none" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header border-bottom border-secondary border-opacity-25 py-3">
        <div class="d-flex align-items-center gap-2">
            <img src="<?= BASE_URL ?>/favicon.jpg?v=1789605784" width="28" height="28" style="border-radius: 6px; object-fit: cover;" onerror="this.style.display='none'">
            <h5 class="offcanvas-title text-white fw-bold mb-0" id="mobileSidebarLabel">Gestão Advogados</h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between px-3 py-3">
        <div class="nav-links">
            <a href="<?= BASE_URL ?>/dashboard" class="nav-link-custom <?= $path == '/dashboard' || $path == '/' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="<?= BASE_URL ?>/clientes" class="nav-link-custom <?= strpos($path, '/clientes') === 0 ? 'active' : '' ?>">
                <i class="bi bi-people me-2"></i> Clientes
            </a>
            <a href="<?= BASE_URL ?>/processos" class="nav-link-custom <?= strpos($path, '/processos') === 0 ? 'active' : '' ?>">
                <i class="bi bi-folder2-open me-2"></i> Processos
            </a>
            <a href="<?= BASE_URL ?>/prazos" class="nav-link-custom <?= strpos($path, '/prazos') === 0 ? 'active' : '' ?>">
                <i class="bi bi-calendar-event me-2"></i> Agenda de Prazos
            </a>
            <a href="<?= BASE_URL ?>/financeiro" class="nav-link-custom <?= strpos($path, '/financeiro') === 0 ? 'active' : '' ?>">
                <i class="bi bi-currency-dollar me-2"></i> Financeiro
            </a>
            <a href="<?= BASE_URL ?>/documentos" class="nav-link-custom <?= strpos($path, '/documentos') === 0 ? 'active' : '' ?>">
                <i class="bi bi-file-earmark-text me-2"></i> Documentos
            </a>
        </div>
        <div class="pt-3 border-top border-secondary border-opacity-25">
            <div class="text-white-50 small mb-2 text-truncate">
                <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($_SESSION['email'] ?? 'Usuário') ?>
            </div>
            <a href="<?= BASE_URL ?>/logout" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-box-arrow-right"></i> Sair da Conta
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- Desktop Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar d-none d-md-block">
            <div class="sidebar-brand">
                <img src="<?= BASE_URL ?>/favicon.jpg?v=1789605784" onerror="this.style.display='none'">
                <span>Gestão Advogados</span>
            </div>
            <a href="<?= BASE_URL ?>/dashboard" class="<?= $path == '/dashboard' || $path == '/' ? 'active' : '' ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
            <a href="<?= BASE_URL ?>/clientes" class="<?= strpos($path, '/clientes') === 0 ? 'active' : '' ?>"><i class="bi bi-people me-2"></i> Clientes</a>
            <a href="<?= BASE_URL ?>/processos" class="<?= strpos($path, '/processos') === 0 ? 'active' : '' ?>"><i class="bi bi-folder2-open me-2"></i> Processos</a>
            <a href="<?= BASE_URL ?>/prazos" class="<?= strpos($path, '/prazos') === 0 ? 'active' : '' ?>"><i class="bi bi-calendar-event me-2"></i> Agenda de Prazos</a>
            <a href="<?= BASE_URL ?>/financeiro" class="<?= strpos($path, '/financeiro') === 0 ? 'active' : '' ?>"><i class="bi bi-currency-dollar me-2"></i> Financeiro</a>
            <a href="<?= BASE_URL ?>/documentos" class="<?= strpos($path, '/documentos') === 0 ? 'active' : '' ?>"><i class="bi bi-file-earmark-text me-2"></i> Documentos</a>
            <hr class="border-secondary my-3">
            <a href="<?= BASE_URL ?>/logout" class="text-danger"><i class="bi bi-box-arrow-right me-2"></i> Sair</a>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 content">
            <div class="d-flex justify-content-between align-items-center navbar-top flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2 text-truncate" style="max-width: 80%;">
                    <i class="bi bi-person-check text-primary fs-5"></i>
                    <h6 class="m-0 text-muted text-truncate">Bem-vindo(a), <strong class="text-dark"><?= htmlspecialchars($_SESSION['email'] ?? '') ?></strong></h6>
                </div>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">
                    <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Online
                </span>
            </div>
            
            <?php if (isset($_SESSION['flash_msg'])): ?>
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= htmlspecialchars($_SESSION['flash_msg']) ?>
                    <?php if(isset($_SESSION['whatsapp_url'])): ?>
                        <div class="mt-3">
                            <a href="<?= $_SESSION['whatsapp_url'] ?>" target="_blank" class="btn btn-success btn-sm">
                                <i class="bi bi-whatsapp me-1"></i> Enviar Mensagem no WhatsApp
                            </a>
                        </div>
                        <?php unset($_SESSION['whatsapp_url']); ?>
                    <?php endif; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    <?php unset($_SESSION['flash_msg']); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['flash_err'])): ?>
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= htmlspecialchars($_SESSION['flash_err']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    <?php unset($_SESSION['flash_err']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($content)) require $content; ?>

        </div>
    </div>
</div>

<!-- Mobile Bottom Navigation Bar (Quick Access) -->
<nav class="mobile-bottom-nav d-md-none">
    <a href="<?= BASE_URL ?>/dashboard" class="<?= $path == '/dashboard' || $path == '/' ? 'active' : '' ?>">
        <i class="bi bi-speedometer2"></i>
        <span>Início</span>
    </a>
    <a href="<?= BASE_URL ?>/clientes" class="<?= strpos($path, '/clientes') === 0 ? 'active' : '' ?>">
        <i class="bi bi-people"></i>
        <span>Clientes</span>
    </a>
    <a href="<?= BASE_URL ?>/processos" class="<?= strpos($path, '/processos') === 0 ? 'active' : '' ?>">
        <i class="bi bi-folder2-open"></i>
        <span>Processos</span>
    </a>
    <a href="<?= BASE_URL ?>/prazos" class="<?= strpos($path, '/prazos') === 0 ? 'active' : '' ?>">
        <i class="bi bi-calendar-event"></i>
        <span>Prazos</span>
    </a>
    <a href="#" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" role="button">
        <i class="bi bi-grid"></i>
        <span>Mais</span>
    </a>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>