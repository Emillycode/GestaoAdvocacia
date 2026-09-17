<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2 class="mb-0 fw-bold">Editar Prazo ou Audiência</h2>
    <a href="<?= BASE_URL ?>/prazos" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-3 p-md-4">
        <form method="POST" action="<?= BASE_URL ?>/prazos/editar/<?= $prazo['id'] ?>">
            <div class="row g-3">
                <div class="col-12 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Processo Referente <span class="text-danger">*</span></label>
                    <select name="processo_id" class="form-select" required>
                        <option value="">Selecione um processo...</option>
                        <?php foreach($processos as $proc): ?>
                            <option value="<?= $proc['id'] ?>" <?= $proc['id'] == $prazo['processo_id'] ? 'selected' : '' ?>>
                                #<?= htmlspecialchars($proc['numero_processo']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-12 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Título / Descrição <span class="text-danger">*</span></label>
                    <input type="text" name="titulo" class="form-control" required value="<?= htmlspecialchars($prazo['titulo']) ?>">
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Data de Vencimento <span class="text-danger">*</span></label>
                    <input type="date" name="data_vencimento" class="form-control" required value="<?= htmlspecialchars($prazo['data_vencimento']) ?>">
                </div>
                
                <div class="col-12 col-md-6 mb-4">
                    <label class="form-label fw-semibold small text-secondary">Tipo de Compromisso</label>
                    <select name="tipo" class="form-select">
                        <option value="Prazo Fatal" <?= $prazo['tipo'] == 'Prazo Fatal' ? 'selected' : '' ?>>Prazo Fatal</option>
                        <option value="Audiência" <?= $prazo['tipo'] == 'Audiência' ? 'selected' : '' ?>>Audiência</option>
                        <option value="Reunião" <?= $prazo['tipo'] == 'Reunião' ? 'selected' : '' ?>>Reunião</option>
                        <option value="Outros" <?= $prazo['tipo'] == 'Outros' ? 'selected' : '' ?>>Outros</option>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-success d-inline-flex align-items-center justify-content-center gap-1">
                    <i class="bi bi-check-lg"></i> Salvar Alterações
                </button>
                <a href="<?= BASE_URL ?>/prazos" class="btn btn-light border">Cancelar</a>
            </div>
        </form>
    </div>
</div>