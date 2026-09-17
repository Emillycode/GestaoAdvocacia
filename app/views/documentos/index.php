<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2 class="mb-0 fw-bold">Gerenciamento de Documentos</h2>
    <a href="<?= BASE_URL ?>/documentos/novo" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-sm">
        <i class="bi bi-upload"></i> Novo Documento
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Data</th>
                        <th>Arquivo</th>
                        <th>Tipo</th>
                        <th>Cliente</th>
                        <th>Processo</th>
                        <th class="text-end pe-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($documentos as $doc): ?>
                    <tr>
                        <td class="ps-3"><?= date('d/m/Y H:i', strtotime($doc['created_at'])) ?></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-file-earmark-pdf text-danger fs-5"></i> 
                                <span class="fw-semibold text-truncate" style="max-width: 200px;"><?= htmlspecialchars($doc['nome_arquivo']) ?></span>
                            </div>
                        </td>
                        <td><span class="badge bg-secondary-subtle text-secondary-emphasis border"><?= htmlspecialchars($doc['tipo_documento']) ?></span></td>
                        <td><?= !empty($doc['cliente_nome']) ? htmlspecialchars($doc['cliente_nome']) : '<span class="text-muted fst-italic">Cliente removido</span>' ?></td>
                        <td><?= $doc['numero_processo'] ? '#' . htmlspecialchars($doc['numero_processo']) : '<span class="text-muted">N/A</span>' ?></td>
                        <td class="text-end pe-3">
                            <a href="<?= BASE_URL ?>/<?= $doc['caminho_arquivo'] ?>" target="_blank" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1">
                                <i class="bi bi-eye"></i> Visualizar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($documentos)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Nenhum documento armazenado.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>