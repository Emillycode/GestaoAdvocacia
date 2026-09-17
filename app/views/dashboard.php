<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2 class="mb-0 fw-bold">Visão Geral</h2>
    <span class="text-muted small"><i class="bi bi-clock me-1"></i> Atualizado em tempo real</span>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6">
        <div class="card text-white bg-primary shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center justify-content-between p-3 p-md-4">
                <div>
                    <h6 class="card-title text-white-50 text-uppercase fw-semibold mb-1 small">Total de Clientes</h6>
                    <p class="card-text fs-1 fw-bold mb-0"><?= $clientesCount ?></p>
                </div>
                <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                    <i class="bi bi-people fs-3"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3 px-md-4">
                <a href="<?= BASE_URL ?>/clientes" class="text-white text-decoration-none small d-flex align-items-center gap-1">
                    Ver todos os clientes <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="card text-white bg-dark shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center justify-content-between p-3 p-md-4">
                <div>
                    <h6 class="card-title text-white-50 text-uppercase fw-semibold mb-1 small">Processos Ativos</h6>
                    <p class="card-text fs-1 fw-bold mb-0"><?= $processosCount ?></p>
                </div>
                <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                    <i class="bi bi-folder2-open fs-3"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3 px-md-4">
                <a href="<?= BASE_URL ?>/processos" class="text-white text-decoration-none small d-flex align-items-center gap-1">
                    Gerenciar processos <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h5 class="text-danger m-0 fw-bold d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-triangle-fill"></i> Prazos para os próximos 7 dias
        </h5>
        <a href="<?= BASE_URL ?>/prazos" class="btn btn-sm btn-outline-secondary">Ver Agenda Completa</a>
    </div>
    <div class="card-body p-0">
        <?php if (count($prazosProximos) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Prazo / Audiência</th>
                            <th>Data de Vencimento</th>
                            <th class="pe-3">Processo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($prazosProximos as $prazo): ?>
                        <tr>
                            <td class="ps-3"><strong><?= htmlspecialchars($prazo['titulo']) ?></strong></td>
                            <td class="text-danger fw-bold"><i class="bi bi-calendar-check me-1"></i><?= date('d/m/Y', strtotime($prazo['data_vencimento'])) ?></td>
                            <td class="pe-3"><span class="badge bg-secondary">#<?= $prazo['processo_id'] ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="p-4 text-center text-muted">
                <i class="bi bi-shield-check text-success fs-2 d-block mb-2"></i>
                <p class="mb-0">Nenhum prazo fatal ou audiência para os próximos 7 dias. Respire aliviado!</p>
            </div>
        <?php endif; ?>
    </div>
</div>