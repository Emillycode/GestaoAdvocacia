<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2 class="mb-0 fw-bold">Novo Prazo / Audiência</h2>
    <a href="<?= BASE_URL ?>/prazos" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-3 p-md-4">
        <form method="POST" action="<?= BASE_URL ?>/prazos/novo">
            <div class="row g-3">
                <div class="col-12 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Vincular a Processo <span class="text-danger">*</span></label>
                    <select name="processo_id" class="form-select" required>
                        <option value="">Selecione o processo correspondente...</option>
                        <?php foreach($processos as $proc): ?>
                            <option value="<?= $proc['id'] ?>">#<?= htmlspecialchars($proc['numero_processo']) ?> - <?= htmlspecialchars($proc['cliente_nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-12 col-md-8 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Título do Prazo / Tarefa <span class="text-danger">*</span></label>
                    <input type="text" name="titulo" class="form-control" required placeholder="Ex: Contestação, Audiência de Instrução, Réplica">
                </div>
                
                <div class="col-12 col-md-4 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="Prazo Judicial">Prazo Judicial</option>
                        <option value="Audiência">Audiência</option>
                        <option value="Reunião com Cliente">Reunião com Cliente</option>
                        <option value="Diligência Externa">Diligência Externa</option>
                    </select>
                </div>
                
                <div class="col-12 mb-4">
                    <label class="form-label fw-semibold small text-secondary">Data e Hora Fatal / Vencimento <span class="text-danger">*</span></label>
                    <input type="date" name="data_vencimento" class="form-control" required>
                </div>
            </div>
            
            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-primary d-inline-flex align-items-center justify-content-center gap-1">
                    <i class="bi bi-calendar-check"></i> Salvar Prazo
                </button>
                <a href="<?= BASE_URL ?>/prazos" class="btn btn-light border">Cancelar</a>
            </div>
        </form>
    </div>
</div>