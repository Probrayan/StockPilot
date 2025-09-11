<?php require_once __DIR__ . '/../controllers/caud.php'; ?>
<div class="conte">
    <h2><i class="fa-solid fa-shield-alt"></i> Auditoría</h2>
    <hr>
    <h4>Registros de Auditoría</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Tabla</th>
                    <th>Acción</th>
                    <th>ID Registro</th>
                    <th>Datos Anteriores</th>
                    <th>Datos Nuevos</th>
                    <th>Fecha</th>
                    <th>IP</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($datAll) {
                    foreach ($datAll as $row) { ?>
                        <tr>
                            <td><?= $row['idaud']; ?></td>
                            <td><?= $row['idusu']; ?></td>
                            <td><?= $row['tabla']; ?></td>
                            <td><?= $row['accion']; ?></td>
                            <td><?= $row['idreg']; ?></td>
                            <td><pre><?= htmlspecialchars($row['datos_ant']); ?></pre></td>
                            <td><pre><?= htmlspecialchars($row['datos_nue']); ?></pre></td>
                            <td><?= $row['fecha']; ?></td>
                            <td><?= $row['ip']; ?></td>
                        </tr>
                <?php }} else { ?>
                    <tr><td colspan="9" class="text-center">No hay registros de auditoría.</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
