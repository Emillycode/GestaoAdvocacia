<div class="mb-4">
    <h2>Novo Lançamento Financeiro</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/financeiro/novo">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo de Receita/Valor</label>
                    <select name="tipo_lancamento" class="form-select" required>
                        <option value="Honorários">Honorários (Dinheiro do Escritório)</option>
                        <option value="Indenização">Indenização (Dinheiro do Cliente)</option>
                        <option value="Custas Judiciais">Custas Judiciais (Dinheiro do Cliente)</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Valor (R$)</label>
                    <input type="number" step="0.01" min="0" name="valor" class="form-control" required placeholder="0.00">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Data do Lançamento</label>
                    <input type="date" name="data_lancamento" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cliente (Opcional, caso não esteja atrelado a um cliente)</label>
                    <select name="cliente_id" class="form-select">
                        <option value="">Nenhum...</option>
                        <?php foreach($clientes as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Descrição / Observações</label>
                    <input type="text" name="descricao" class="form-control" placeholder="Ex: Alvará ref. processo XYZ" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Salvar Lançamento</button>
            <a href="<?= BASE_URL ?>/financeiro" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
