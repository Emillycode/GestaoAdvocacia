<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Processos e Casos</h2>
    <a href="<?= BASE_URL ?>/processos/novo" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Processo</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nº Processo</th>
                        <th>Cliente</th>
                        <th>Tribunal / Vara</th>
                        <th>Parte Contrária</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($processos as $processo): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($processo['numero_processo']) ?></strong></td>
                        <td><?= htmlspecialchars($processo['cliente_nome']) ?></td>
                        <td><?= htmlspecialchars($processo['tribunal']) ?> / <?= htmlspecialchars($processo['vara']) ?></td>
                        <td><?= htmlspecialchars($processo['parte_contraria']) ?></td>
                        <td>
                            <?php if($processo['status'] == 'Ativo'): ?>
                                <span class="badge bg-success">Ativo</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?= htmlspecialchars($processo['status']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= BASE_URL ?>/processos/editar/<?= $processo['id'] ?>" class="btn btn-sm btn-outline-primary" title="Editar Andamento"><i class="bi bi-pencil"></i> Editar</a>
                                <a href="<?= BASE_URL ?>/processos/excluir/<?= $processo['id'] ?>" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este processo?');"><i class="bi bi-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
