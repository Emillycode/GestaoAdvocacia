<?php
// config.php
define('DB_FILE', __DIR__ . '/db/database.sqlite');
$envBaseUrl = getenv('BASE_URL') !== false ? getenv('BASE_URL') : (isset(<?php
// config.php
define('DB_FILE', __DIR__ . '/db/database.sqlite');
define('BASE_URL', getenv('BASE_URL') ?: 'http://localhost/Gestaoadvocacia'); // Ajuste conforme necessario

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        // Se o banco nÃƒÆ’Ã‚Â£o existir, tentamos rodar o setup (apenas uma vez para facilitar o uso do usuÃƒÆ’Ã‚Â¡rio)
        $isNew = !file_exists(DB_FILE);
        $pdo = new PDO('sqlite:' . DB_FILE);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        if ($isNew) {
            require_once __DIR__ . '/db/setup.php';
        }
    }
    return $pdo;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['2fa_verified']) && $_SESSION['2fa_verified'] === true;
}

function redirect($path) {
    header("Location: " . BASE_URL . $path);
    exit;
}
SERVER['BASE_URL']) ? <?php
// config.php
define('DB_FILE', __DIR__ . '/db/database.sqlite');
define('BASE_URL', getenv('BASE_URL') ?: 'http://localhost/Gestaoadvocacia'); // Ajuste conforme necessÃƒÆ’Ã‚Â¡rio

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        // Se o banco nao existir, tentamos rodar o setup (apenas uma vez para facilitar o uso do usuario)
        $isNew = !file_exists(DB_FILE);
        $pdo = new PDO('sqlite:' . DB_FILE);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        if ($isNew) {
            require_once __DIR__ . '/db/setup.php';
        }
    }
    return $pdo;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['2fa_verified']) && $_SESSION['2fa_verified'] === true;
}

function redirect($path) {
    header("Location: " . BASE_URL . $path);
    exit;
}
SERVER['BASE_URL'] : 'http://localhost/Gestaoadvocacia');
define('BASE_URL', $envBaseUrl); // Ajuste conforme necessario

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        // Se o banco nao existir, tentamos rodar o setup (apenas uma vez para facilitar o uso do usuario)
        $isNew = !file_exists(DB_FILE);
        $pdo = new PDO('sqlite:' . DB_FILE);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        if ($isNew) {
            require_once __DIR__ . '/db/setup.php';
        }
    }
    return $pdo;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['2fa_verified']) && $_SESSION['2fa_verified'] === true;
}

function redirect($path) {
    header("Location: " . BASE_URL . $path);
    exit;
}
