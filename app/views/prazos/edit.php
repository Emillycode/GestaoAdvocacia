<div class="mb-4">
    <h2>Editar Prazo ou Audiência</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/prazos/editar/<?= $prazo['id'] ?>">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Processo Referente</label>
                    <select name="processo_id" class="form-select" required>
                        <option value="">Selecione um processo...</option>
                        <?php foreach($processos as $processo): ?>
                            <option value="<?= $processo['id'] ?>" <?= $processo['id'] == $prazo['processo_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($processo['numero_processo']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Título / Descrição</label>
                    <input type="text" name="titulo" class="form-control" required value="<?= htmlspecialchars($prazo['titulo']) ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Data e Hora (Vencimento)</label>
                    <input type="date" name="data_vencimento" class="form-control" required value="<?= htmlspecialchars($prazo['data_vencimento']) ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo de Compromisso</label>
                    <select name="tipo" class="form-select">
                        <option value="Prazo Fatal" <?= $prazo['tipo'] == 'Prazo Fatal' ? 'selected' : '' ?>>Prazo Fatal</option>
                        <option value="Audiência" <?= $prazo['tipo'] == 'Audiência' ? 'selected' : '' ?>>Audiência</option>
                        <option value="Reunião" <?= $prazo['tipo'] == 'Reunião' ? 'selected' : '' ?>>Reunião</option>
                        <option value="Outros" <?= $prazo['tipo'] == 'Outros' ? 'selected' : '' ?>>Outros</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="<?= BASE_URL ?>/prazos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
