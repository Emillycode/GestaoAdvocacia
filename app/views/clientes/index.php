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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clientes as $cliente): ?>
                    <tr>
                        <td><?= $cliente['id'] ?></td>
                        <td><strong><?= htmlspecialchars($cliente['nome']) ?></strong></td>
                        <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                        <td><?= htmlspecialchars($cliente['email']) ?></td>
                        <td><?= htmlspecialchars($cliente['cpf_cnpj']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
