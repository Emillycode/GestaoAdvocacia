<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2 class="mb-0 fw-bold">Clientes</h2>
    <a href="<?= BASE_URL ?>/clientes/novo" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-sm">
        <i class="bi bi-person-plus-fill"></i> Novo Cliente
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Nome</th>
                        <th>E-mail</th>
                        <th>Telefone (WhatsApp)</th>
                        <th>CPF / CNPJ</th>
                        <th class="text-end pe-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clientes as $cliente): ?>
                    <tr>
                        <td class="ps-3"><strong><?= htmlspecialchars($cliente['nome']) ?></strong></td>
                        <td><?= htmlspecialchars($cliente['email']) ?></td>
                        <td>
                            <?php if(!empty($cliente['telefone'])): ?>
                                <a href="https://wa.me/55<?= preg_replace('/\D/', '', $cliente['telefone']) ?>" target="_blank" class="text-success text-decoration-none fw-semibold">
                                    <i class="bi bi-whatsapp me-1"></i><?= htmlspecialchars($cliente['telefone']) ?>
                                </a>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($cliente['cpf_cnpj']) ?></td>
                        <td class="text-end pe-3">
                            <div class="d-inline-flex gap-2">
                                <a href="<?= BASE_URL ?>/clientes/editar/<?= $cliente['id'] ?>" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="<?= BASE_URL ?>/clientes/excluir/<?= $cliente['id'] ?>" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este cliente?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($clientes)): ?>
                        <tr><td colspan="5" class="text-center text-muted py-4">Nenhum cliente cadastrado ainda.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>