<h2 class="mb-4">Visão Geral</h2>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-white bg-primary mb-3 shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">Total de Clientes</h5>
                <p class="card-text fs-2 fw-bold"><?= $clientesCount ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-secondary mb-3 shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">Processos Ativos</h5>
                <p class="card-text fs-2 fw-bold"><?= $processosCount ?></p>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h5 class="text-danger"><i class="bi bi-exclamation-triangle"></i> Prazos para os próximos 7 dias</h5>
    </div>
    <div class="card-body">
        <?php if (count($prazosProximos) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Prazo / Audiência</th>
                            <th>Data de Vencimento</th>
                            <th>Processo ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($prazosProximos as $prazo): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($prazo['titulo']) ?></strong></td>
                            <td class="text-danger fw-bold"><?= date('d/m/Y', strtotime($prazo['data_vencimento'])) ?></td>
                            <td>#<?= $prazo['processo_id'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">Nenhum prazo fatal ou audiência para os próximos 7 dias. Respire aliviado!</p>
        <?php endif; ?>
    </div>
</div>
