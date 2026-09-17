<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2 class="mb-0 fw-bold">Agenda de Prazos e Audiências</h2>
    <a href="<?= BASE_URL ?>/prazos/novo" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-sm">
        <i class="bi bi-calendar-plus"></i> Novo Prazo
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Processo</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Vencimento</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Ações</th>
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
                            $classeLinha = 'table-light text-muted';
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
                                $alerta = '<span class="badge bg-info text-dark">No prazo</span>';
                            }
                        }
                    ?>
                    <tr class="<?= $classeLinha ?>">
                        <td class="ps-3"><strong><?= !empty($prazo['numero_processo']) ? '#' . htmlspecialchars($prazo['numero_processo']) : '<span class="text-muted fst-italic">Processo removido</span>' ?></strong></td>
                        <td><?= htmlspecialchars($prazo['titulo']) ?></td>
                        <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($prazo['tipo']) ?></span></td>
                        <td><?= $vencimento->format('d/m/Y') ?></td>
                        <td><?= $alerta ?></td>
                        <td class="text-end pe-3">
                            <div class="d-inline-flex gap-2">
                                <?php if($prazo['concluido'] == 0): ?>
                                    <a href="<?= BASE_URL ?>/prazos/concluir/<?= $prazo['id'] ?>" class="btn btn-sm btn-success" title="Concluir" onclick="return confirm('Marcar como concluído?');">
                                        <i class="bi bi-check2"></i>
                                    </a>
                                <?php endif; ?>
                                <a href="<?= BASE_URL ?>/prazos/editar/<?= $prazo['id'] ?>" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="<?= BASE_URL ?>/prazos/excluir/<?= $prazo['id'] ?>" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este prazo?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($prazos)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Nenhum prazo cadastrado na agenda.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>