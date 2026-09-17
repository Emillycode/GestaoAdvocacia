<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Agenda de Prazos e Audiências</h2>
    <a href="<?= BASE_URL ?>/prazos/novo" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo Prazo</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Processo</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Vencimento</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $hoje = new DateTime();
                    foreach($prazos as $prazo): 
                        $vencimento = new DateTime($prazo['data_vencimento']);
                        $diff = $hoje->diff($vencimento);
                        
                        $classeLinha = '';
                        $alerta = '';
                        
                        if ($prazo['concluido'] == 1) {
                            $classeLinha = 'table-success text-muted';
                            $alerta = '<span class="badge bg-success">Concluído</span>';
                        } else {
                            if ($vencimento < $hoje) {
                                $classeLinha = 'table-danger';
                                $alerta = '<span class="badge bg-danger">Atrasado!</span>';
                            } elseif ($diff->days <= 3) {
                                $classeLinha = 'table-danger';
                                $alerta = '<span class="badge bg-danger"><i class="bi bi-exclamation-triangle"></i> ' . $diff->days . ' dias</span>';
                            } elseif ($diff->days <= 7) {
                                $classeLinha = 'table-warning';
                                $alerta = '<span class="badge bg-warning text-dark"><i class="bi bi-exclamation-circle"></i> ' . $diff->days . ' dias</span>';
                            } else {
                                $alerta = '<span class="badge bg-info">No prazo</span>';
                            }
                        }
                    ?>
                    <tr class="<?= $classeLinha ?>">
                        <td><strong><?= !empty($prazo['numero_processo']) ? '#' . htmlspecialchars($prazo['numero_processo']) : '<span class="text-muted fst-italic">Processo removido</span>' ?></strong></td>
                        <td><?= htmlspecialchars($prazo['titulo']) ?></td>
                        <td><?= htmlspecialchars($prazo['tipo']) ?></td>
                        <td><?= $vencimento->format('d/m/Y') ?></td>
                        <td><?= $alerta ?></td>
                        <td>
                            <?php if($prazo['concluido'] == 0): ?>
                                <a href="<?= BASE_URL ?>/prazos/concluir/<?= $prazo['id'] ?>" class="btn btn-sm btn-success" title="Concluir" onclick="return confirm('Marcar como concluído?');"><i class="bi bi-check2"></i></a>
                            <?php endif; ?>
                            <a href="<?= BASE_URL ?>/prazos/editar/<?= $prazo['id'] ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i> Editar</a>
                            <a href="<?= BASE_URL ?>/prazos/excluir/<?= $prazo['id'] ?>" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este prazo?');"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
