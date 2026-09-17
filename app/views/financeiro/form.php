<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2 class="mb-0 fw-bold">Novo Lançamento Financeiro</h2>
    <a href="<?= BASE_URL ?>/financeiro" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-3 p-md-4">
        <form method="POST" action="<?= BASE_URL ?>/financeiro/novo">
            <div class="row g-3">
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Descrição <span class="text-danger">*</span></label>
                    <input type="text" name="descricao" class="form-control" required placeholder="Ex: Entrada de Honorários Iniciais">
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Valor (R$) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" step="0.01" name="valor" class="form-control" required placeholder="0.00">
                    </div>
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Tipo de Lançamento <span class="text-danger">*</span></label>
                    <select name="tipo_lancamento" class="form-select" required>
                        <option value="Honorários">Honorários Advocatícios (Receita)</option>
                        <option value="Indenização">Indenização (Dinheiro do Cliente)</option>
                        <option value="Custas">Custas / Reembolso</option>
                    </select>
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Data do Lançamento <span class="text-danger">*</span></label>
                    <input type="date" name="data_lancamento" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>
                
                <div class="col-12 mb-4">
                    <label class="form-label fw-semibold small text-secondary">Cliente Relacionado (Opcional)</label>
                    <select name="cliente_id" class="form-select">
                        <option value="">Nenhum cliente vinculado</option>
                        <?php foreach($clientes as $cli): ?>
                            <option value="<?= $cli['id'] ?>"><?= htmlspecialchars($cli['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-success d-inline-flex align-items-center justify-content-center gap-1">
                    <i class="bi bi-check-lg"></i> Registrar Lançamento
                </button>
                <a href="<?= BASE_URL ?>/financeiro" class="btn btn-light border">Cancelar</a>
            </div>
        </form>
    </div>
</div>