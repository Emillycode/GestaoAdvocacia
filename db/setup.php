<?php
$dbFile = __DIR__ . '/database.sqlite';

if (file_exists($dbFile)) {
    unlink($dbFile);
    echo "Banco de dados antigo removido.\n";
}

try {
    $pdo = new PDO('sqlite:' . $dbFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Tabela Usuarios
    $pdo->exec("CREATE TABLE usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT NOT NULL UNIQUE,
        senha TEXT NOT NULL,
        codigo_2fa TEXT,
        expiracao_2fa DATETIME
    )");

    // Tabela Clientes
    $pdo->exec("CREATE TABLE clientes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        email TEXT,
        telefone TEXT,
        cpf_cnpj TEXT
    )");

    // Tabela Processos
    $pdo->exec("CREATE TABLE processos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        cliente_id INTEGER NOT NULL,
        numero_processo TEXT NOT NULL UNIQUE,
        tribunal TEXT,
        vara TEXT,
        parte_contraria TEXT,
        status TEXT,
        andamento_resumido TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY(cliente_id) REFERENCES clientes(id)
    )");

    // Tabela Prazos
    $pdo->exec("CREATE TABLE prazos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        processo_id INTEGER NOT NULL,
        titulo TEXT NOT NULL,
        data_vencimento DATE NOT NULL,
        tipo TEXT, -- audiencia, prazo_fatal
        concluido INTEGER DEFAULT 0,
        FOREIGN KEY(processo_id) REFERENCES processos(id)
    )");

    // Tabela Financeiro
    $pdo->exec("CREATE TABLE financeiro (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        cliente_id INTEGER,
        tipo_lancamento TEXT NOT NULL, -- honorarios, indenizacao, custas
        valor REAL NOT NULL,
        data_lancamento DATE NOT NULL,
        mes_referencia TEXT NOT NULL, -- ex: 2026-09
        descricao TEXT,
        FOREIGN KEY(cliente_id) REFERENCES clientes(id)
    )");

    // Tabela Documentos
    $pdo->exec("CREATE TABLE documentos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        cliente_id INTEGER NOT NULL,
        processo_id INTEGER,
        nome_arquivo TEXT NOT NULL,
        caminho_arquivo TEXT NOT NULL,
        tipo_documento TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY(cliente_id) REFERENCES clientes(id),
        FOREIGN KEY(processo_id) REFERENCES processos(id)
    )");

    // Inserir usuário padrão Adm@2026
    $senhaHash = password_hash('Adm@2026', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)");
    $stmt->execute(['admin@escritorio.com', $senhaHash]);

    echo "Banco de dados criado com sucesso e usuário admin inserido!\n";

} catch (PDOException $e) {
    echo "Erro ao criar banco de dados: " . $e->getMessage() . "\n";
}
