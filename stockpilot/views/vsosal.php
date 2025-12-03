<?php require_once __DIR__ . '/../controllers/csosal.php'; ?>

<div class="conte">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h2><i class="fa-solid fa-arrow-right-from-bracket"></i> Detalle de Salida</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="home.php">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="home.php?pg=1016">Salidas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                </ol>
            </nav>
        </div>
        <?php if (isset($detalles) && count($detalles) > 0): ?>
            <a href="home.php?pg=1016&idsol=<?= $idsol ?>&aprobar=1" 
               class="btn btn-danger btn-lg shadow" 
               onclick="return confirm('¿Aprobar esta solicitud y crear movimientos de SALIDA en el Kardex?\n\nEsto disminuirá automáticamente los productos del inventario.')">
                <i class="fa-solid fa-check-circle"></i> Aprobar y Crear en Kardex
            </a>
        <?php endif; ?>
    </div>
    
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-<?= $_SESSION['tipo_mensaje'] == 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i>
            <?= $_SESSION['mensaje'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php 
        unset($_SESSION['mensaje']);
        unset($_SESSION['tipo_mensaje']);
        ?>
    <?php endif; ?>

    <div class="row">
        <!-- Columna Izquierda: Formulario -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fa-solid fa-minus-circle"></i> Agregar Producto</h5>
                </div>
                <div class="card-body">
                    <form action="home.php?pg=1016&idsol=<?= htmlspecialchars($idsol) ?>" method="POST" id="formDetalle">
                        <input type="hidden" name="ope" value="save">
                        
                        <div class="mb-3">
                            <label for="idprod" class="form-label"><i class="fa-solid fa-box"></i> Producto <span class="text-danger">*</span></label>
                            <select name="idprod" id="idprod" class="form-select" required>
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
                        
                        <div class="row g-2">
                            <div class="col-md-6 mb-3">
                                <label for="cantdet" class="form-label"><i class="fa-solid fa-hashtag"></i> Cantidad <span class="text-danger">*</span></label>
                                <input type="number" name="cantdet" id="cantdet" class="form-control" min="1" step="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="vundet" class="form-label"><i class="fa-solid fa-dollar-sign"></i> Valor Unitario <span class="text-danger">*</span></label>
                                <input type="number" name="vundet" id="vundet" class="form-control" min="0" step="0.01" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="total_preview" class="form-label"><i class="fa-solid fa-calculator"></i> Total Estimado</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" id="total_preview" class="form-control bg-light" readonly>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-save"></i> Guardar Producto
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-eraser"></i> Limpiar Formulario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Columna Derecha: Lista -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-secondary"><i class="fa-solid fa-list-ol"></i> Detalles Registrados</h5>
                    <?php if (isset($detalles) && count($detalles) > 0): ?>
                        <span class="badge bg-danger rounded-pill"><?= count($detalles) ?> items</span>
                    <?php endif; ?>
                </div>
                <div class="card-body p-0">
                    <?php if (isset($detalles) && is_array($detalles) && count($detalles) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle mb-0" id="tableDetalles">
                                <thead class="table-light">
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-center">Cant.</th>
                                        <th class="text-end">Valor Unit.</th>
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
                                        <td class="fw-bold"><?= htmlspecialchars($d['nomprod']) ?></td>
                                        <td class="text-center"><span class="badge bg-secondary"><?= htmlspecialchars($d['cantdet']) ?></span></td>
                                        <td class="text-end">$<?= number_format($d['vundet'], 2, ',', '.') ?></td>
                                        <td class="text-end fw-bold text-danger">$<?= number_format($d['totdet'], 2, ',', '.') ?></td>
                                        <td class="text-center">
                                            <a href="home.php?pg=1016&idsol=<?= $idsol ?>&delete=<?= $d['iddet'] ?>" 
                                               class="btn btn-outline-danger btn-sm" 
                                               onclick="return confirm('¿Está seguro de eliminar este registro?')"
                                               title="Eliminar">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot class="table-light border-top-2">
                                    <tr>
                                        <th colspan="3" class="text-end text-uppercase">Total General:</th>
                                        <th class="text-end fs-5 text-danger">$<?= number_format($gran_total, 2, ',', '.') ?></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No hay productos registrados en esta solicitud.<br>Utilice el formulario para agregar items.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

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
    
    if(cantidadInput && valorInput) {
        cantidadInput.addEventListener('input', calcularTotal);
        valorInput.addEventListener('input', calcularTotal);
    }
    
    const form = document.getElementById('formDetalle');
    if(form) {
        form.addEventListener('reset', function() {
            setTimeout(() => { totalPreview.value = ''; }, 10);
        });
    }
    
    // Inicializar DataTables si hay tabla
    if($('#tableDetalles').length) {
        $('#tableDetalles').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            },
            pageLength: 10,
            responsive: true,
            dom: 'rtip'
        });
    }
});
</script>