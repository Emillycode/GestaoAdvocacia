<div class="mb-4">
    <h2>Novo Documento</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>/documentos/novo" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Arquivo</label>
                    <input type="file" name="arquivo" class="form-control" required accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo de Documento</label>
                    <select name="tipo_documento" class="form-select" required>
                        <option value="Procuração">Procuração</option>
                        <option value="Contrato de Honorários">Contrato de Honorários</option>
                        <option value="Petição">Petição</option>
                        <option value="Documento Pessoal">Documento Pessoal (RG/CPF)</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cliente (Obrigatório)</label>
                    <select name="cliente_id" class="form-select" required>
                        <option value="">Selecione...</option>
                        <?php foreach($clientes as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Processo Referente (Opcional)</label>
                    <select name="processo_id" class="form-select">
                        <option value="">Nenhum (Apenas do cliente)</option>
                        <?php foreach($processos as $processo): ?>
                            <option value="<?= $processo['id'] ?>"><?= htmlspecialchars($processo['numero_processo']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Fazer Upload</button>
            <a href="<?= BASE_URL ?>/documentos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
