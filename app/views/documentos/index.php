<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gerenciamento de Documentos</h2>
    <a href="<?= BASE_URL ?>/documentos/novo" class="btn btn-primary"><i class="bi bi-upload"></i> Novo Documento</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Arquivo</th>
                        <th>Tipo</th>
                        <th>Cliente</th>
                        <th>Processo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($documentos as $doc): ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($doc['created_at'])) ?></td>
                        <td>
                            <i class="bi bi-file-earmark-pdf text-danger"></i> 
                            <?= htmlspecialchars($doc['nome_arquivo']) ?>
                        </td>
                        <td><span class="badge bg-secondary"><?= htmlspecialchars($doc['tipo_documento']) ?></span></td>
                        <td><?= !empty($doc['cliente_nome']) ? htmlspecialchars($doc['cliente_nome']) : '<span class="text-muted fst-italic">Cliente removido</span>' ?></td>
                        <td><?= $doc['numero_processo'] ? '#' . htmlspecialchars($doc['numero_processo']) : '<span class="text-muted">N/A</span>' ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= BASE_URL ?>/<?= $doc['caminho_arquivo'] ?>" target="_blank" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i> Visualizar</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($documentos)): ?>
                        <tr><td colspan="6" class="text-center text-muted">Nenhum documento armazenado.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
