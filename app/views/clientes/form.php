<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2 class="mb-0 fw-bold">Novo Cliente</h2>
    <a href="<?= BASE_URL ?>/clientes" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-3 p-md-4">
        <form action="<?= BASE_URL ?>/clientes/novo" method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold small text-secondary">Nome Completo <span class="text-danger">*</span></label>
                <input type="text" name="nome" class="form-control" required placeholder="Ex: Dr. João da Silva">
            </div>
            <div class="row g-3 mb-3">
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold small text-secondary">E-mail</label>
                    <input type="email" name="email" class="form-control" placeholder="cliente@exemplo.com">
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold small text-secondary">Telefone (WhatsApp)</label>
                    <input type="tel" name="telefone" class="form-control" placeholder="(00) 00000-0000">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small text-secondary">CPF / CNPJ</label>
                <input type="text" name="cpf_cnpj" class="form-control" placeholder="000.000.000-00">
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold small text-secondary">Observações / Detalhes</label>
                <textarea name="observacao" class="form-control" rows="3" placeholder="Informações adicionais do cliente..."></textarea>
            </div>
            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-primary d-inline-flex align-items-center justify-content-center gap-1">
                    <i class="bi bi-check-lg"></i> Salvar Cliente
                </button>
                <a href="<?= BASE_URL ?>/clientes" class="btn btn-light border">Cancelar</a>
            </div>
        </form>
    </div>
</div>