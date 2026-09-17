<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h2 class="mb-0 fw-bold">Novo Documento</h2>
    <a href="<?= BASE_URL ?>/documentos" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-3 p-md-4">
        <form method="POST" action="<?= BASE_URL ?>/documentos/novo" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-12 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Selecionar Arquivo (PDF, Imagem, etc.) <span class="text-danger">*</span></label>
                    <input type="file" name="arquivo" class="form-control" required>
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Tipo de Documento</label>
                    <select name="tipo_documento" class="form-select">
                        <option value="Procuração">Procuração</option>
                        <option value="Petição">Petição</option>
                        <option value="Documento Pessoal">Documento Pessoal (RG/CPF)</option>
                        <option value="Comprovante">Comprovante de Residência</option>
                        <option value="Contrato">Contrato de Honorários</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
                
                <div class="col-12 col-md-6 mb-2">
                    <label class="form-label fw-semibold small text-secondary">Cliente Relacionado</label>
                    <select name="cliente_id" class="form-select">
                        <option value="">Sem cliente específico</option>
                        <?php foreach($clientes as $cli): ?>
                            <option value="<?= $cli['id'] ?>"><?= htmlspecialchars($cli['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-12 mb-4">
                    <label class="form-label fw-semibold small text-secondary">Processo Relacionado (Opcional)</label>
                    <select name="processo_id" class="form-select">
                        <option value="">Sem processo específico</option>
                        <?php foreach($processos as $proc): ?>
                            <option value="<?= $proc['id'] ?>">#<?= htmlspecialchars($proc['numero_processo']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-primary d-inline-flex align-items-center justify-content-center gap-1">
                    <i class="bi bi-upload"></i> Fazer Upload do Documento
                </button>
                <a href="<?= BASE_URL ?>/documentos" class="btn btn-light border">Cancelar</a>
            </div>
        </form>
    </div>
</div>