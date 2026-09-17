<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2 class="mb-0 fw-bold">Novo Processo</h2>
    <a href="<?= BASE_URL ?>/processos" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-3 p-md-4">
        <form method="POST" action="<?= BASE_URL ?>/processos/novo">
            <div class="row g-3">
                <div class="col-12 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Cliente <span class="text-danger">*</span></label>
                    <select name="cliente_id" class="form-select" required>
                        <option value="">Selecione um cliente...</option>
                        <?php foreach($clientes as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Número do Processo (Exato) <span class="text-danger">*</span></label>
                    <input type="text" name="numero_processo" class="form-control" required placeholder="0000000-00.0000.0.00.0000">
                    <div class="form-text small">O sistema validará se este número já existe.</div>
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Parte Contrária <span class="text-danger">*</span></label>
                    <input type="text" name="parte_contraria" class="form-control" required placeholder="Nome do réu ou autor adverso">
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Tribunal</label>
                    <input type="text" name="tribunal" class="form-control" placeholder="Ex: TJSP, TRF3, TST">
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Vara</label>
                    <input type="text" name="vara" class="form-control" placeholder="Ex: 1ª Vara Cível">
                </div>
                
                <div class="col-12 mb-4">
                    <label class="form-label fw-semibold small text-secondary">Status Inicial</label>
                    <select name="status" class="form-select">
                        <option value="Ativo">Ativo</option>
                        <option value="Suspenso">Suspenso</option>
                        <option value="Arquivado">Arquivado</option>
                        <option value="Encerrado">Encerrado</option>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-success d-inline-flex align-items-center justify-content-center gap-1">
                    <i class="bi bi-check-lg"></i> Salvar Processo
                </button>
                <a href="<?= BASE_URL ?>/processos" class="btn btn-light border">Cancelar</a>
            </div>
        </form>
    </div>
</div>