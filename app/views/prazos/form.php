<div class="mb-4">
    <h2>Novo Prazo ou Audiência</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/prazos/novo">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Processo Referente</label>
                    <select name="processo_id" class="form-select" required>
                        <option value="">Selecione um processo...</option>
                        <?php foreach($processos as $processo): ?>
                            <option value="<?= $processo['id'] ?>"><?= htmlspecialchars($processo['numero_processo']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Título / Descrição</label>
                    <input type="text" name="titulo" class="form-control" required placeholder="Ex: Audiência de Conciliação">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Data e Hora (Vencimento)</label>
                    <input type="date" name="data_vencimento" class="form-control" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo de Compromisso</label>
                    <select name="tipo" class="form-select">
                        <option value="Prazo Fatal">Prazo Fatal</option>
                        <option value="Audiência">Audiência</option>
                        <option value="Reunião">Reunião</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Salvar Compromisso</button>
            <a href="<?= BASE_URL ?>/prazos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
