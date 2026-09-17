<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2 class="mb-0 fw-bold">Financeiro</h2>
    <a href="<?= BASE_URL ?>/financeiro/novo" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-sm">
        <i class="bi bi-plus-lg"></i> Novo Lançamento
    </a>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-4">
        <div class="card shadow-sm border-0 h-100 p-3 bg-white">
            <form method="GET" class="d-flex flex-column justify-content-center h-100">
                <label class="form-label text-muted small fw-semibold text-uppercase">Mês de Referência</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-calendar3"></i></span>
                    <input type="month" name="mes" class="form-control border-start-0" value="<?= htmlspecialchars($mes_atual) ?>" onchange="this.form.submit()">
                </div>
            </form>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
        <div class="card bg-success text-white shadow-sm border-0 h-100">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-white-50 small fw-semibold text-uppercase">Honorários (Escritório)</span>
                    <i class="bi bi-wallet2 fs-4 text-white-50"></i>
                </div>
                <h3 class="mb-0 fw-bold">R$ <?= number_format($totalHonorarios, 2, ',', '.') ?></h3>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
        <div class="card bg-info text-white shadow-sm border-0 h-100">
            <div class="card-body p-3 p-md-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-white-50 small fw-semibold text-uppercase">Clientes (Indenizações/Custas)</span>
                    <i class="bi bi-bank fs-4 text-white-50"></i>
                </div>
                <h3 class="mb-0 fw-bold">R$ <?= number_format($totalClientes, 2, ',', '.') ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom py-3">
        <h5 class="m-0 fw-bold text-dark"><i class="bi bi-receipt me-2 text-primary"></i>Lançamentos do Mês</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Data</th>
                        <th>Descrição</th>
                        <th>Cliente</th>
                        <th>Tipo</th>
                        <th class="text-end pe-3">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lancamentos as $lan): ?>
                    <tr>
                        <td class="ps-3"><?= date('d/m/Y', strtotime($lan['data_lancamento'])) ?></td>
                        <td><strong><?= htmlspecialchars($lan['descricao']) ?></strong></td>
                        <td><?= $lan['cliente_nome'] ? htmlspecialchars($lan['cliente_nome']) : '<span class="text-muted">N/A</span>' ?></td>
                        <td>
                            <?php if($lan['tipo_lancamento'] == 'Honorários'): ?>
                                <span class="badge bg-success-subtle text-success border border-success-subtle">Honorários</span>
                            <?php else: ?>
                                <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle">Cliente (<?= htmlspecialchars($lan['tipo_lancamento']) ?>)</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-3"><strong>R$ <?= number_format($lan['valor'], 2, ',', '.') ?></strong></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($lancamentos)): ?>
                        <tr><td colspan="5" class="text-center text-muted py-4">Nenhum lançamento registrado neste mês.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>