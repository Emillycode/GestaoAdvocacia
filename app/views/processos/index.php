<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2 class="mb-0 fw-bold">Processos e Casos</h2>
    <a href="<?= BASE_URL ?>/processos/novo" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-sm">
        <i class="bi bi-plus-lg"></i> Novo Processo
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Nº Processo</th>
                        <th>Cliente</th>
                        <th>Tribunal / Vara</th>
                        <th>Parte Contrária</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($processos as $processo): ?>
                    <tr>
                        <td class="ps-3"><strong><?= htmlspecialchars($processo['numero_processo']) ?></strong></td>
                        <td><?= !empty($processo['cliente_nome']) ? htmlspecialchars($processo['cliente_nome']) : '<span class="text-muted fst-italic">Cliente removido / não vinculado</span>' ?></td>
                        <td><?= htmlspecialchars($processo['tribunal']) ?> / <?= htmlspecialchars($processo['vara']) ?></td>
                        <td><?= htmlspecialchars($processo['parte_contraria']) ?></td>
                        <td>
                            <?php if($processo['status'] == 'Ativo'): ?>
                                <span class="badge bg-success">Ativo</span>
                            <?php elseif($processo['status'] == 'Suspenso'): ?>
                                <span class="badge bg-warning text-dark">Suspenso</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?= htmlspecialchars($processo['status']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-3">
                            <div class="d-inline-flex gap-2">
                                <a href="<?= BASE_URL ?>/processos/editar/<?= $processo['id'] ?>" class="btn btn-sm btn-outline-primary" title="Editar Andamento">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="<?= BASE_URL ?>/processos/excluir/<?= $processo['id'] ?>" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este processo?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($processos)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Nenhum processo cadastrado.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>