<div class="mb-4">
    <h2>Novo Processo</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/processos/novo">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-select" required>
                        <option value="">Selecione um cliente...</option>
                        <?php foreach($clientes as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Número do Processo (Exato)</label>
                    <input type="text" name="numero_processo" class="form-control" required placeholder="0000000-00.0000.0.00.0000">
                    <div class="form-text">O sistema validará se este número já existe.</div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Parte Contrária</label>
                    <input type="text" name="parte_contraria" class="form-control" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tribunal</label>
                    <input type="text" name="tribunal" class="form-control" placeholder="Ex: TJSP">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vara</label>
                    <input type="text" name="vara" class="form-control" placeholder="Ex: 1ª Vara Cível">
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Status Inicial</label>
                    <select name="status" class="form-select">
                        <option value="Ativo">Ativo</option>
                        <option value="Suspenso">Suspenso</option>
                        <option value="Arquivado">Arquivado</option>
                        <option value="Encerrado">Encerrado</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Salvar Processo</button>
            <a href="<?= BASE_URL ?>/processos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
