<?php
// config.php
define('DB_FILE', __DIR__ . '/db/database.sqlite');

$isRender = isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'onrender.com') !== false;
if ($isRender) {
    define('BASE_URL', 'https://' . $_SERVER['HTTP_HOST']);
} else {
    define('BASE_URL', 'http://localhost/Gestaoadvocacia');
}

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
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
