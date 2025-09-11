<?php 
require_once __DIR__ . '/../controllers/csoent.php'; 
?>

<div class="conte">
    <h2><i class="fa-solid fa-list"></i> Detalle de Entrada</h2>
    
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensaje'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php 
        unset($_SESSION['mensaje']);
        unset($_SESSION['tipo_mensaje']);
        ?>
    <?php endif; ?>

    <!-- Formulario -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Agregar Producto</h5>
        </div>
        <div class="card-body">
            <form action="dashboard.php?pg=2060&idsol=<?= htmlspecialchars($idsol) ?>" method="POST" id="formDetalle">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idsol" value="<?= htmlspecialchars($idsol) ?>">
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="idprod" class="form-label">Producto <span class="text-danger">*</span></label>
                        <select name="idprod" id="idprod" class="form-control" required>
                            <option value="">Seleccione un producto...</option>
                            <?php if (isset($productos) && is_array($productos)): ?>
                                <?php foreach ($productos as $p): ?>
                                    <option value="<?= htmlspecialchars($p['idprod']) ?>">
                                        <?= htmlspecialchars($p['nomprod']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label for="cantdet" class="form-label">Cantidad <span class="text-danger">*</span></label>
                        <input type="number" name="cantdet" id="cantdet" class="form-control" min="1" step="1" required>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="vundet" class="form-label">Valor Unitario <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="vundet" id="vundet" class="form-control" min="0" step="0.01" required>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="total_preview" class="form-label">Total</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="text" id="total_preview" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-save"></i> Guardar
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fa-solid fa-eraser"></i> Limpiar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <hr>

    <!-- Lista de detalles -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detalles Registrados</h5>
            <?php if (isset($detalles) && count($detalles) > 0): ?>
                <span class="badge bg-primary"><?= count($detalles) ?> productos</span>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <?php if (isset($detalles) && is_array($detalles) && count($detalles) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Valor Unitario</th>
                                <th class="text-end">Total</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $gran_total = 0;
                            foreach ($detalles as $d): 
                                $gran_total += $d['totdet'];
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($d['nomprod']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($d['cantdet']) ?></td>
                                <td class="text-end">$<?= number_format($d['vundet'], 2, ',', '.') ?></td>
                                <td class="text-end">$<?= number_format($d['totdet'], 2, ',', '.') ?></td>
                                <td class="text-center">
                                    <a href="dashboard.php?pg=2060&idsol=<?= $idsol ?>&delete=<?= $d['iddet'] ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('¿Está seguro de eliminar este registro?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-secondary">
                            <tr>
                                <th colspan="3" class="text-end">TOTAL GENERAL:</th>
                                <th class="text-end">$<?= number_format($gran_total, 2, ',', '.') ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4">
                    <i class="fa-solid fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No hay productos registrados en esta solicitud</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cantidadInput = document.getElementById('cantdet');
    const valorInput = document.getElementById('vundet');
    const totalPreview = document.getElementById('total_preview');
    
    function calcularTotal() {
        const cantidad = parseFloat(cantidadInput.value) || 0;
        const valor = parseFloat(valorInput.value) || 0;
        const total = cantidad * valor;
        totalPreview.value = total.toFixed(2);
    }
    
    cantidadInput.addEventListener('input', calcularTotal);
    valorInput.addEventListener('input', calcularTotal);
    
    // Limpiar el preview al resetear
    document.getElementById('formDetalle').addEventListener('reset', function() {
        totalPreview.value = '';
    });
});
</script>