<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Financeiro</h2>
    <a href="<?= BASE_URL ?>/financeiro/novo" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Lançamento</a>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <form method="GET" class="d-flex align-items-end">
            <div class="me-2 flex-grow-1">
                <label class="form-label">Mês Referência</label>
                <input type="month" name="mes" class="form-control" value="<?= htmlspecialchars($mes_atual) ?>" onchange="this.form.submit()">
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white shadow-sm border-0 h-100">
            <div class="card-body">
                <h6>Total Honorários (Escritório)</h6>
                <h3 class="mb-0">R$ <?= number_format($totalHonorarios, 2, ',', '.') ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white shadow-sm border-0 h-100">
            <div class="card-body">
                <h6>Total Clientes (Indenizações/Custas)</h6>
                <h3 class="mb-0">R$ <?= number_format($totalClientes, 2, ',', '.') ?></h3>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <ul class="nav nav-tabs mb-3" id="financeiroTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#todos" type="button">Todos os Lançamentos</button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="todos">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Cliente (Opcional)</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lancamentos as $lan): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($lan['data_lancamento'])) ?></td>
                                <td><?= htmlspecialchars($lan['descricao']) ?></td>
                                <td><?= $lan['cliente_nome'] ? htmlspecialchars($lan['cliente_nome']) : '<span class="text-muted">N/A</span>' ?></td>
                                <td>
                                    <?php if($lan['tipo_lancamento'] == 'Honorários'): ?>
                                        <span class="badge bg-success">Honorários</span>
                                    <?php else: ?>
                                        <span class="badge bg-info">Dinheiro do Cliente</span> (<?= htmlspecialchars($lan['tipo_lancamento']) ?>)
                                    <?php endif; ?>
                                </td>
                                <td><strong>R$ <?= number_format($lan['valor'], 2, ',', '.') ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($lancamentos)): ?>
                                <tr><td colspan="5" class="text-center text-muted">Nenhum lançamento neste mês.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
