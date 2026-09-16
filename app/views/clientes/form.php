<div class="mb-4">
    <h2>Novo Cliente</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/clientes/novo">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome Completo / Razão Social</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">CPF / CNPJ</label>
                    <input type="text" name="cpf_cnpj" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Telefone (WhatsApp)</label>
                    <input type="text" name="telefone" class="form-control" placeholder="Ex: 5511999999999" required>
                    <div class="form-text">Inclua o código do país para integração com WhatsApp.</div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Salvar Cliente</button>
            <a href="<?= BASE_URL ?>/clientes" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
