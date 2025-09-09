<?php
//require_once('controllers/funciones.php');
require_once('controllers/cinv.php');
?>
<h2>Inventario</h2><i class="fa--solid fa-box"></i>



<form action="index.php?pg=<?=$pg;?>" method="POST">

        <div class="row">

                <div class="form-group col-md-6">
                    <label for="nominv">Nombre del Inventario</label>
                    <input type="text" class="form-control" id="nominv" name="nominv" value="<?php if($datOne && $datOne[0]['nominv']) echo $datOne[0]['nominv']; ?>">
                </div>
                        <div class="form-group col-md-6">
                            <br>
                        <input type="submit" class="form-control btn btn-dark" value="Enviar">
                        </div>

        </div>

</form>

<table id="table" class="table table-striped">
        <thead>
            <tr>
                <th>Nombre del inventario</th>
                <th>Detalle de entrada</th>
                <th></th> 
            </tr>
        </thead>
        <tbody>
            <?php if($datAll){ foreach ($datAll AS $dt){ ?>
            <tr>
                <td><?=$dt['nominv'];?></td>
                <td><?=$dt['iddet'];?></td>
                <td>
                    <a href="index.php?pg=<?=$pg;?>&idprd=<?=$dt['idprd'];?>&ope=edi" title="Editar">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                    </a>
                    <a href="index.php?pg=<?=$pg;?>&idprd=<?=$dt['idprd'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                        <i class="fa-solid fa-trash-can fa-2x"></i>
                    </a>
                </td>
            </tr>
            <?php }}?>
        </tbody>
        <thead>
            <tr>
               <th>Nombre del inventario</th>
                <th>Detalle de entrada</th>
                <th></th>  
            </tr>
        </thead>

    </table>