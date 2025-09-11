<?php require_once __DIR__ . '/../controllers/ckard.php'; ?>
<div class="conte">
    <h2><i class="fa-solid fa-boxes"></i> Kardex</h2>

    <div class="inser">
        <form id="frmins" action="dashboard.php?pg=2001" method="POST">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="anio">Año</label>
                    <input type="number" name="anio" id="anio" class="form-control" required 
                        value="<?php if(!empty($datOne)) echo $datOne[0]['anio']; else echo date('Y'); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="mes">Mes</label>
                    <input type="number" name="mes" id="mes" min="1" max="12" class="form-control" required
                        value="<?php if(!empty($datOne)) echo $datOne[0]['mes']; else echo date('n'); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="cerrado">Estado</label>
                    <select name="cerrado" id="cerrado" class="form-select">
                        <option value="0" <?php if ($datOne && $datOne[0]['cerrado'] == 0) echo 'selected'; ?>>Abierto</option>
                        <option value="1" <?php if ($datOne && $datOne[0]['cerrado'] == 1) echo 'selected'; ?>>Cerrado</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <br>
                    <input class="btn btn-primary" type="submit" value="Guardar">
                    <input type="hidden" name="ope" value="save">
                    <input type="hidden" name="idkar" value="<?php if (!empty($datOne)) echo $datOne[0]['idkar']; ?>">
                </div>
            </div>
        </form>
    </div>

    <hr>

    <h4>Lista de Kardex</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Año</th>
                <th>Mes</th>
                <th>Estado</th>
                <th>Total Movimientos</th>
                <th>Balance Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($dtKardex) {
                foreach ($dtKardex as $row) { ?>
                    <tr>
                        <td><?= $row['anio']; ?></td>
                        <td><?= $row['mes']; ?></td>
                        <td><?= ($row['cerrado'] ? "Cerrado" : "Abierto"); ?></td>
                        <td><?= $row['total_movs']; ?></td>
                        <td><?= $row['balance']; ?></td>
                        <td>
                            <a href="dashboard.php?pg=2001&idkar=<?= $row['idkar']; ?>" 
                               class="btn btn-sm btn-info">Ver Movimientos</a>
                            <a href="dashboard.php?pg=2001&idkar=<?= $row['idkar']; ?>&ope=edi" 
                               class="btn btn-sm btn-warning">Editar</a>
                            <?php if ($row['total_movs'] == 0) { ?>
                                <a href="dashboard.php?pg=2001&idkar=<?= $row['idkar']; ?>&ope=eli" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('¿Seguro que desea eliminar este Kardex?')">
                                   Eliminar
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
            <?php }
            } else { ?>
                <tr><td colspan="6" class="text-center">No hay registros</td></tr>
            <?php } ?>
        </tbody>
    </table>

    <hr>

    <?php if (!empty($dtMovimientos)) { ?>
        <h5>Movimientos del Kardex (Año <?= $datOne[0]['anio'] ?? '' ?>, Mes <?= $datOne[0]['mes'] ?? '' ?>)</h5>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Valor</th>
                    <th>Doc Ref</th>
                    <th>Obs</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dtMovimientos as $mov) { ?>
                    <tr>
                        <td><?= $mov['fecha']; ?></td>
                        <td><?= $mov['producto']; ?></td>
                        <td><?= $mov['tipmov']; ?></td>
                        <td><?= $mov['cantmov']; ?></td>
                        <td><?= number_format($mov['valmov'], 2); ?></td>
                        <td><?= $mov['docref']; ?></td>
                        <td><?= $mov['obs']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } elseif ($idkar) { ?>
        <p class="text-muted">⚠️ Este kardex aún no tiene movimientos</p>
    <?php } ?>

    <?php if ($idkar) { ?>
        <h5>Agregar Movimiento</h5>
        <form action="dashboard.php?pg=2001" method="POST">
            <input type="hidden" name="ope" value="addmov">
            <input type="hidden" name="idkar" value="<?= $idkar; ?>">

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="idprod">Producto</label>
                    <select name="idprod" class="form-select" required>
                        <?php foreach ($productos as $prod) { ?>
                            <option value="<?= $prod['idprod']; ?>"><?= $prod['nomprod']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="tipmov">Tipo</label>
                    <select name="tipmov" class="form-select">
                        <option value="Entrada">Entrada</option>
                        <option value="Salida">Salida</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="cantmov">Cantidad</label>
                    <input type="number" name="cantmov" class="form-control" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="valmov">Valor</label>
                    <input type="number" name="valmov" class="form-control" required step="0.01">
                </div>
                <div class="form-group col-md-2">
                    <label for="docref">Doc Ref</label>
                    <input type="text" name="docref" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label for="obs">Obs</label>
                    <textarea name="obs" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12 mt-2">
                    <input type="submit" class="btn btn-success" value="Guardar Movimiento">
                </div>
            </div>
        </form>
    <?php } ?>
</div>
