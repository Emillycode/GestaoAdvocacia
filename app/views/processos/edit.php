<div class="mb-4">
    <h2>Atualizar Processo N° <?= htmlspecialchars($processo['numero_processo']) ?></h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/processos/editar/<?= $processo['id'] ?>">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-select" required>
                        <option value="">Selecione um cliente...</option>
                        <?php foreach($clientes as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>" <?= $processo['cliente_id'] == $cliente['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cliente['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Número do Processo (Exato)</label>
                    <input type="text" name="numero_processo" class="form-control" required placeholder="0000000-00.0000.0.00.0000" value="<?= htmlspecialchars($processo['numero_processo']) ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Parte Contrária</label>
                    <input type="text" name="parte_contraria" class="form-control" required value="<?= htmlspecialchars($processo['parte_contraria']) ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tribunal</label>
                    <input type="text" name="tribunal" class="form-control" placeholder="Ex: TJSP" value="<?= htmlspecialchars($processo['tribunal']) ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vara</label>
                    <input type="text" name="vara" class="form-control" placeholder="Ex: 1ª Vara Cível" value="<?= htmlspecialchars($processo['vara']) ?>">
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Status do Processo</label>
                    <select name="status" class="form-select">
                        <option value="Ativo" <?= $processo['status'] == 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                        <option value="Suspenso" <?= $processo['status'] == 'Suspenso' ? 'selected' : '' ?>>Suspenso</option>
                        <option value="Arquivado" <?= $processo['status'] == 'Arquivado' ? 'selected' : '' ?>>Arquivado</option>
                        <option value="Encerrado" <?= $processo['status'] == 'Encerrado' ? 'selected' : '' ?>>Encerrado</option>
                    </select>
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Andamento Resumido</label>
                    <textarea name="andamento_resumido" class="form-control" rows="4" placeholder="Descreva de forma simples para o cliente..."><?= htmlspecialchars($processo['andamento_resumido'] ?? '') ?></textarea>
                    <div class="form-text text-success"><i class="bi bi-whatsapp"></i> Ao alterar este campo e salvar, o cliente será notificado no WhatsApp automaticamente.</div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Altera&ccedil;&otilde;es</button>
            <a href="<?= BASE_URL ?>/processos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>