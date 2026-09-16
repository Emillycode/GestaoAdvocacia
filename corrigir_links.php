<?php
$diretorioViews = __DIR__ . '/app/views';

// Função para varrer a pasta e substituir os links
function corrigirArquivos($dir) {
    $arquivos = scandir($dir);
    foreach ($arquivos as $arquivo) {
        if ($arquivo === '.' || $arquivo === '..') continue;
        
        $caminho = $dir . '/' . $arquivo;
        if (is_dir($caminho)) {
            corrigirArquivos($caminho);
        } elseif (pathinfo($caminho, PATHINFO_EXTENSION) === 'php') {
            $conteudo = file_get_contents($caminho);
            // Corrige action="/..."
            $conteudo = preg_replace('/action="\/([^"]*)"/', 'action="<?= BASE_URL ?>/$1"', $conteudo);
            // Corrige href="/..."
            $conteudo = preg_replace('/href="\/([^"]*)"/', 'href="<?= BASE_URL ?>/$1"', $conteudo);
            
            file_put_contents($caminho, $conteudo);
        }
    }
}

corrigirArquivos($diretorioViews);
echo "<h1>Links corrigidos com sucesso!</h1><p>Agora você pode acessar o sistema normalmente.</p>";
?>
