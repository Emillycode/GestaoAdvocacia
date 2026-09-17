<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Cliente</h2>
    <a href="<?= BASE_URL ?>/clientes" class="btn btn-secondary">Voltar</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="<?= BASE_URL ?>/clientes/editar/<?= $cliente['id'] ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Nome Completo</label>
                <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($cliente['email']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Telefone (WhatsApp)</label>
                    <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($cliente['telefone']) ?>">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">CPF/CNPJ</label>
                <input type="text" name="cpf_cnpj" class="form-control" value="<?= htmlspecialchars($cliente['cpf_cnpj']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Observação</label>
                <textarea name="observacao" class="form-control" rows="3"><?= htmlspecialchars($cliente['observacao'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
</div>