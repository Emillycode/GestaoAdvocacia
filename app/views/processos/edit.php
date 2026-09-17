<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="mb-0 fw-bold">Editar Processo</h2>
        <span class="text-muted small">Nº <?= htmlspecialchars($processo['numero_processo']) ?></span>
    </div>
    <a href="<?= BASE_URL ?>/processos" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-3 p-md-4">
        <form method="POST" action="<?= BASE_URL ?>/processos/editar/<?= $processo['id'] ?>">
            <div class="row g-3">
                <div class="col-12 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Cliente <span class="text-danger">*</span></label>
                    <select name="cliente_id" class="form-select" required>
                        <option value="">Selecione um cliente...</option>
                        <?php foreach($clientes as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>" <?= $processo['cliente_id'] == $cliente['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cliente['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Número do Processo (Exato) <span class="text-danger">*</span></label>
                    <input type="text" name="numero_processo" class="form-control" required placeholder="0000000-00.0000.0.00.0000" value="<?= htmlspecialchars($processo['numero_processo']) ?>">
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Parte Contrária <span class="text-danger">*</span></label>
                    <input type="text" name="parte_contraria" class="form-control" required value="<?= htmlspecialchars($processo['parte_contraria']) ?>">
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Tribunal</label>
                    <input type="text" name="tribunal" class="form-control" placeholder="Ex: TJSP" value="<?= htmlspecialchars($processo['tribunal']) ?>">
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Vara</label>
                    <input type="text" name="vara" class="form-control" placeholder="Ex: 1ª Vara Cível" value="<?= htmlspecialchars($processo['vara']) ?>">
                </div>
                
                <div class="col-12 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Status do Processo</label>
                    <select name="status" class="form-select">
                        <option value="Ativo" <?= $processo['status'] == 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                        <option value="Suspenso" <?= $processo['status'] == 'Suspenso' ? 'selected' : '' ?>>Suspenso</option>
                        <option value="Arquivado" <?= $processo['status'] == 'Arquivado' ? 'selected' : '' ?>>Arquivado</option>
                        <option value="Encerrado" <?= $processo['status'] == 'Encerrado' ? 'selected' : '' ?>>Encerrado</option>
                    </select>
                </div>
                
                <div class="col-12 mb-4">
                    <label class="form-label fw-semibold small text-secondary">Andamento Resumido</label>
                    <textarea name="andamento_resumido" class="form-control" rows="4" placeholder="Descreva de forma simples para o cliente..."><?= htmlspecialchars($processo['andamento_resumido'] ?? '') ?></textarea>
                    <div class="form-text text-success d-flex align-items-center gap-1 mt-1 small">
                        <i class="bi bi-whatsapp"></i> Ao alterar este campo e salvar, o link de notificação do WhatsApp é gerado automaticamente.
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-primary d-inline-flex align-items-center justify-content-center gap-1">
                    <i class="bi bi-check-lg"></i> Salvar Alterações
                </button>
                <a href="<?= BASE_URL ?>/processos" class="btn btn-light border">Cancelar</a>
            </div>
        </form>
    </div>
</div>