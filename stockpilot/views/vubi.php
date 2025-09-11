<?php require_once __DIR__ . '/../controllers/cubi.php'; ?>
<div class="conte">
    <h2><i class="fa-solid fa-location-dot"></i> Ubicaciones</h2>
    <hr>
    <h4>Lista de Ubicaciones</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Dirección</th>
                    <th>Departamento</th>
                    <th>Ciudad</th>
                    <th>Empresa</th>
                    <th>Responsable</th>
                    <th>Creación</th>
                    <th>Actualización</th>
                    <th>Activo</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($datAll) {
                    foreach ($datAll as $row) { ?>
                        <tr>
                            <td><?= $row['idubi']; ?></td>
                            <td><?= $row['nomubi']; ?></td>
                            <td><?= $row['codubi']; ?></td>
                            <td><?= $row['dirubi']; ?></td>
                            <td><?= $row['depubi']; ?></td>
                            <td><?= $row['ciuubi']; ?></td>
                            <td><?= $row['idemp']; ?></td>
                            <td><?= $row['idresp']; ?></td>
                            <td><?= $row['fec_crea']; ?></td>
                            <td><?= $row['fec_actu']; ?></td>
                            <td><?= $row['act'] ? 'Sí' : 'No'; ?></td>
                        </tr>
                <?php }} else { ?>
                    <tr><td colspan="11" class="text-center">No hay ubicaciones registradas.</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
