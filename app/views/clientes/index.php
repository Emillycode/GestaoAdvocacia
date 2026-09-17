<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Clientes</h2>
    <a href="<?= BASE_URL ?>/clientes/novo" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Cliente</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Telefone (WhatsApp)</th>
                        <th>E-mail</th>
                        <th>CPF/CNPJ</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clientes as $cliente): ?>
                    <tr>
                        <td><?= $cliente['id'] ?></td>
                        <td>
                            <strong><?= htmlspecialchars($cliente['nome']) ?></strong>
                            <?php if(!empty($cliente['observacao'])): ?>
                                <br><small class="text-muted"><i class="bi bi-info-circle"></i> <?= htmlspecialchars(mb_strimwidth($cliente['observacao'], 0, 50, '...')) ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                        <td><?= htmlspecialchars($cliente['email']) ?></td>
                        <td><?= htmlspecialchars($cliente['cpf_cnpj']) ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= BASE_URL ?>/clientes/editar/<?= $cliente['id'] ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i> Editar</a>
                            <a href="<?= BASE_URL ?>/clientes/excluir/<?= $cliente['id'] ?>" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este cliente?');"><i class="bi bi-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>