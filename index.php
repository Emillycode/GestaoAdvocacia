<?php
// index.php
session_start();
require_once 'config.php';

$request = $_SERVER['REQUEST_URI'];
\$basePath = getenv('BASE_PATH') !== false ? getenv('BASE_PATH') : (isset(<?php
// index.php
session_start();
require_once 'config.php';

$request = $_SERVER['REQUEST_URI'];
$basePath = getenv('BASE_PATH') !== false ? getenv('BASE_PATH') : '/Gestaoadvocacia'; // Nome da sua pasta no WAMP
$path = parse_url($request, PHP_URL_PATH);
// Remove o nome da pasta da rota para o sistema entender

if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}
if ($path == '') $path = '/';

// Para testes locais com PHP Built-in server
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|pdf)$/', $path)) {
    return false; // serve o arquivo requisitado como estÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡tico
}

// Rotas pÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âºblicas
if (!isLoggedIn() && $path !== '/login' && $path !== '/login/2fa') {
    redirect('/login');
}

switch ($path) {
    case '/':
    case '/dashboard':
        require 'app/controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
        break;
        
    case '/login':
        require 'app/controllers/AuthController.php';
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->loginPost();
        } else {
            $controller->login();
        }
        break;
        
    case '/login/2fa':
        require 'app/controllers/AuthController.php';
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->verify2faPost();
        } else {
            $controller->verify2fa();
        }
        break;
        
    case '/logout':
        session_destroy();
        redirect('/login');
        break;
        
    // Rotas de Clientes
    case '/clientes':
        require 'app/controllers/ClienteController.php';
        (new ClienteController())->index();
        break;
    case (preg_match('/^\/clientes\/editar\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/ClienteController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ClienteController())->update($matches[1]);
        else (new ClienteController())->edit($matches[1]);
        break;
    case (preg_match('/^\/clientes\/excluir\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/ClienteController.php';
        (new ClienteController())->delete($matches[1]);
        break;
    case '/clientes/novo':
        require 'app/controllers/ClienteController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ClienteController())->store();
        else (new ClienteController())->create();
        break;
        
    // Rotas de Processos
    case '/processos':
        require 'app/controllers/ProcessoController.php';
        (new ProcessoController())->index();
        break;
    case '/processos/novo':
        require 'app/controllers/ProcessoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ProcessoController())->store();
        else (new ProcessoController())->create();
        break;
    case (preg_match('/^\/processos\/editar\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/ProcessoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ProcessoController())->update($matches[1]);
        else (new ProcessoController())->edit($matches[1]);
        break;
    case (preg_match('/^\/processos\/excluir\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/ProcessoController.php';
        (new ProcessoController())->delete($matches[1]);
        break;
        
    // Rotas de Prazos
    case '/prazos':
        require 'app/controllers/PrazoController.php';
        (new PrazoController())->index();
        break;
    case (preg_match('/^\/prazos\/editar\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/PrazoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new PrazoController())->update($matches[1]);
        else (new PrazoController())->edit($matches[1]);
        break;
    case (preg_match('/^\/prazos\/excluir\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/PrazoController.php';
        (new PrazoController())->delete($matches[1]);
        break;
    case '/prazos/novo':
        require 'app/controllers/PrazoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new PrazoController())->store();
        else (new PrazoController())->create();
        break;
    case (preg_match('/^\/prazos\/concluir\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/PrazoController.php';
        (new PrazoController())->concluir($matches[1]);
        break;
        
    // Rotas do Financeiro
    case '/financeiro':
        require 'app/controllers/FinanceiroController.php';
        (new FinanceiroController())->index();
        break;
    case '/financeiro/novo':
        require 'app/controllers/FinanceiroController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new FinanceiroController())->store();
        else (new FinanceiroController())->create();
        break;
        
    // Rotas de Documentos
    case '/documentos':
        require 'app/controllers/DocumentoController.php';
        (new DocumentoController())->index();
        break;
    case '/documentos/novo':
        require 'app/controllers/DocumentoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new DocumentoController())->store();
        else (new DocumentoController())->create();
        break;
        
    default:
        http_response_code(404);
        echo "404 - PÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡gina nÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£o encontrada.";
        break;
}

SERVER['BASE_PATH']) ? <?php
// index.php
session_start();
require_once 'config.php';

$request = $_SERVER['REQUEST_URI'];
$basePath = getenv('BASE_PATH') !== false ? getenv('BASE_PATH') : '/Gestaoadvocacia'; // Nome da sua pasta no WAMP
$path = parse_url($request, PHP_URL_PATH);
// Remove o nome da pasta da rota para o sistema entender

if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}
if ($path == '') $path = '/';

// Para testes locais com PHP Built-in server
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|pdf)$/', $path)) {
    return false; // serve o arquivo requisitado como estÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡tico
}

// Rotas pÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âºblicas
if (!isLoggedIn() && $path !== '/login' && $path !== '/login/2fa') {
    redirect('/login');
}

switch ($path) {
    case '/':
    case '/dashboard':
        require 'app/controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
        break;
        
    case '/login':
        require 'app/controllers/AuthController.php';
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->loginPost();
        } else {
            $controller->login();
        }
        break;
        
    case '/login/2fa':
        require 'app/controllers/AuthController.php';
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->verify2faPost();
        } else {
            $controller->verify2fa();
        }
        break;
        
    case '/logout':
        session_destroy();
        redirect('/login');
        break;
        
    // Rotas de Clientes
    case '/clientes':
        require 'app/controllers/ClienteController.php';
        (new ClienteController())->index();
        break;
    case (preg_match('/^\/clientes\/editar\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/ClienteController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ClienteController())->update($matches[1]);
        else (new ClienteController())->edit($matches[1]);
        break;
    case (preg_match('/^\/clientes\/excluir\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/ClienteController.php';
        (new ClienteController())->delete($matches[1]);
        break;
    case '/clientes/novo':
        require 'app/controllers/ClienteController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ClienteController())->store();
        else (new ClienteController())->create();
        break;
        
    // Rotas de Processos
    case '/processos':
        require 'app/controllers/ProcessoController.php';
        (new ProcessoController())->index();
        break;
    case '/processos/novo':
        require 'app/controllers/ProcessoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ProcessoController())->store();
        else (new ProcessoController())->create();
        break;
    case (preg_match('/^\/processos\/editar\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/ProcessoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ProcessoController())->update($matches[1]);
        else (new ProcessoController())->edit($matches[1]);
        break;
    case (preg_match('/^\/processos\/excluir\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/ProcessoController.php';
        (new ProcessoController())->delete($matches[1]);
        break;
        
    // Rotas de Prazos
    case '/prazos':
        require 'app/controllers/PrazoController.php';
        (new PrazoController())->index();
        break;
    case (preg_match('/^\/prazos\/editar\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/PrazoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new PrazoController())->update($matches[1]);
        else (new PrazoController())->edit($matches[1]);
        break;
    case (preg_match('/^\/prazos\/excluir\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/PrazoController.php';
        (new PrazoController())->delete($matches[1]);
        break;
    case '/prazos/novo':
        require 'app/controllers/PrazoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new PrazoController())->store();
        else (new PrazoController())->create();
        break;
    case (preg_match('/^\/prazos\/concluir\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/PrazoController.php';
        (new PrazoController())->concluir($matches[1]);
        break;
        
    // Rotas do Financeiro
    case '/financeiro':
        require 'app/controllers/FinanceiroController.php';
        (new FinanceiroController())->index();
        break;
    case '/financeiro/novo':
        require 'app/controllers/FinanceiroController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new FinanceiroController())->store();
        else (new FinanceiroController())->create();
        break;
        
    // Rotas de Documentos
    case '/documentos':
        require 'app/controllers/DocumentoController.php';
        (new DocumentoController())->index();
        break;
    case '/documentos/novo':
        require 'app/controllers/DocumentoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new DocumentoController())->store();
        else (new DocumentoController())->create();
        break;
        
    default:
        http_response_code(404);
        echo "404 - PÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡gina nÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£o encontrada.";
        break;
}

SERVER['BASE_PATH'] : '/Gestaoadvocacia'); // Nome da sua pasta no WAMP
$path = parse_url($request, PHP_URL_PATH);
// Remove o nome da pasta da rota para o sistema entender

if (strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}
if ($path == '') $path = '/';

// Para testes locais com PHP Built-in server
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|pdf)$/', $path)) {
    return false; 
}

if (!isLoggedIn() && $path !== '/login' && $path !== '/login/2fa') {
    redirect('/login');
}

switch ($path) {
    case '/':
    case '/dashboard':
        require 'app/controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
        break;
        
    case '/login':
        require 'app/controllers/AuthController.php';
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->loginPost();
        } else {
            $controller->login();
        }
        break;
        
    case '/login/2fa':
        require 'app/controllers/AuthController.php';
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->verify2faPost();
        } else {
            $controller->verify2fa();
        }
        break;
        
    case '/logout':
        session_destroy();
        redirect('/login');
        break;
        
    // Rotas de Clientes
    case '/clientes':
        require 'app/controllers/ClienteController.php';
        (new ClienteController())->index();
        break;
    case (preg_match('/^\/clientes\/editar\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/ClienteController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ClienteController())->update($matches[1]);
        else (new ClienteController())->edit($matches[1]);
        break;
    case (preg_match('/^\/clientes\/excluir\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/ClienteController.php';
        (new ClienteController())->delete($matches[1]);
        break;
    case '/clientes/novo':
        require 'app/controllers/ClienteController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ClienteController())->store();
        else (new ClienteController())->create();
        break;
        
    // Rotas de Processos
    case '/processos':
        require 'app/controllers/ProcessoController.php';
        (new ProcessoController())->index();
        break;
    case '/processos/novo':
        require 'app/controllers/ProcessoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ProcessoController())->store();
        else (new ProcessoController())->create();
        break;
    case (preg_match('/^\/processos\/editar\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/ProcessoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new ProcessoController())->update($matches[1]);
        else (new ProcessoController())->edit($matches[1]);
        break;
    case (preg_match('/^\/processos\/excluir\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/ProcessoController.php';
        (new ProcessoController())->delete($matches[1]);
        break;
        
    // Rotas de Prazos
    case '/prazos':
        require 'app/controllers/PrazoController.php';
        (new PrazoController())->index();
        break;
    case (preg_match('/^\/prazos\/editar\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/PrazoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new PrazoController())->update($matches[1]);
        else (new PrazoController())->edit($matches[1]);
        break;
    case (preg_match('/^\/prazos\/excluir\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/PrazoController.php';
        (new PrazoController())->delete($matches[1]);
        break;
    case '/prazos/novo':
        require 'app/controllers/PrazoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new PrazoController())->store();
        else (new PrazoController())->create();
        break;
    case (preg_match('/^\/prazos\/concluir\/(\d+)$/', $path, $matches) ? true : false):
        require 'app/controllers/PrazoController.php';
        (new PrazoController())->concluir($matches[1]);
        break;
        
    // Rotas do Financeiro
    case '/financeiro':
        require 'app/controllers/FinanceiroController.php';
        (new FinanceiroController())->index();
        break;
    case '/financeiro/novo':
        require 'app/controllers/FinanceiroController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new FinanceiroController())->store();
        else (new FinanceiroController())->create();
        break;
        
    // Rotas de Documentos
    case '/documentos':
        require 'app/controllers/DocumentoController.php';
        (new DocumentoController())->index();
        break;
    case '/documentos/novo':
        require 'app/controllers/DocumentoController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') (new DocumentoController())->store();
        else (new DocumentoController())->create();
        break;
        
    default:
        http_response_code(404);
        echo "404 - Pagina não encontrada.";
        break;
}

