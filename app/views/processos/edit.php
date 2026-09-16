<div class="mb-4">
    <h2>Atualizar Andamento - Processo Nº <?= htmlspecialchars($processo['numero_processo']) ?></h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/processos/editar/<?= $processo['id'] ?>">
            <div class="row">
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
            <button type="submit" class="btn btn-primary">Salvar e Notificar</button>
            <a href="<?= BASE_URL ?>/processos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
