<?php
include("controllers/cmovim.php");
?>

<h2><?php echo $dtOne ? "Editar Movimiento" : "Nuevo Movimiento"; ?> <i class="fas fa-exchange-alt"></i></h2>

<form action="home.php?pg=<?=$pg?>" method="POST">
    <div class="row">

        <input type="hidden" name="idmov" value="<?php echo $dtOne[0]['idmov'] ?? ''; ?>">
        <input type="hidden" name="ope" value="SaVe">

        <div class="form-group col-md-6">
            <label for="idemp">Empresa</label>
            <input type="text" name="idemp" id="idemp" class="form-control" 
                   value="<?php echo $dtOne[0]['idemp'] ?? ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="idkar">Kardex</label>
            <input type="text" name="idkar" id="idkar" class="form-control" 
                   value="<?php echo $dtOne[0]['idkar'] ?? ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="idprod">Producto</label>
            <input type="text" name="idprod" id="idprod" class="form-control" 
                   value="<?php echo $dtOne[0]['idprod'] ?? ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="idubi">Ubicación</label>
            <input type="text" name="idubi" id="idubi" class="form-control" 
                   value="<?php echo $dtOne[0]['idubi'] ?? ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="fecmov">Fecha Movimiento</label>
            <input type="date" name="fecmov" id="fecmov" class="form-control" 
                   value="<?php echo $dtOne[0]['fecmov'] ?? ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="tipmov">Tipo</label>
            <select name="tipmov" id="tipmov" class="form-control" required>
                <option value="">-- Seleccione --</option>
                <option value="1" <?php echo (isset($dtOne[0]['tipmov']) && $dtOne[0]['tipmov']==1) ? "selected" : ""; ?>>Entrada</option>
                <option value="2" <?php echo (isset($dtOne[0]['tipmov']) && $dtOne[0]['tipmov']==2) ? "selected" : ""; ?>>Salida</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="cantmov">Cantidad</label>
            <input type="number" name="cantmov" id="cantmov" class="form-control" 
                   value="<?php echo $dtOne[0]['cantmov'] ?? ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="valmov">Valor Unitario</label>
            <input type="number" step="0.01" name="valmov" id="valmov" class="form-control" 
                   value="<?php echo $dtOne[0]['valmov'] ?? ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="costprom">Costo Promedio</label>
            <input type="number" step="0.01" name="costprom" id="costprom" class="form-control" 
                   value="<?php echo $dtOne[0]['costprom'] ?? ''; ?>">
        </div>

        <div class="form-group col-md-6">
            <label for="docref">Documento Ref</label>
            <input type="text" name="docref" id="docref" class="form-control" 
                   value="<?php echo $dtOne[0]['docref'] ?? ''; ?>">
        </div>

        <div class="form-group col-md-12">
            <label for="obs">Observaciones</label>
            <textarea name="obs" id="obs" class="form-control"><?php echo $dtOne[0]['obs'] ?? ''; ?></textarea>
        </div>

        <div class="form-group col-md-6">
            <label for="idusu">Usuario</label>
            <input type="text" name="idusu" id="idusu" class="form-control" 
                   value="<?php echo $dtOne[0]['idusu'] ?? ''; ?>" required>
        </div>

        <div class="form-group col-md-12">
            <br>
            <input type="submit" class="form-control btn btn-dark" value="Guardar">
            <a href="home.php?pg=<?=$pg?>" class="btn btn-secondary mt-2">Cancelar</a>
        </div>
    </div>
</form>

<hr>

<h2>Listado de Movimientos</h2>
<table id="table" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Empresa</th>
            <th>Kardex</th>
            <th>Producto</th>
            <th>Ubicación</th>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Cantidad</th>
            <th>Valor</th>
            <th>Doc Ref</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if($dtAll){ foreach($dtAll as $row): ?>
        <tr>
            <td><?=$row['idmov'];?></td>
            <td><?=$row['idemp'];?></td>
            <td><?=$row['idkar'];?></td>
            <td><?=$row['idprod'];?></td>
            <td><?=$row['idubi'];?></td>
            <td><?=$row['fecmov'];?></td>
            <td><?=$row['tipmov']==1 ? "Entrada" : "Salida";?></td>
            <td><?=$row['cantmov'];?></td>
            <td><?=$row['valmov'];?></td>
            <td><?=$row['docref'];?></td>
            <td><?=$row['idusu'];?></td>
            <td>
                <a href="index.php?pg=<?=$pg;?>&idmov=<?=$row['idmov'];?>&ope=eDi" title="Editar">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                </a>
                <a href="index.php?pg=<?=$pg;?>&idmov=<?=$row['idmov'];?>&ope=eLi" title="Eliminar" onclick="return confirm('¿Eliminar este movimiento?')">
                    <i class="fa-solid fa-trash-can fa-2x"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; }?>
    </tbody>
</table>
