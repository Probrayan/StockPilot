<?php
require_once('controllers/ccat.php');
?>
<h2>Categoria</h2> <i class="fas fa-folder"></i>


<form action="home.php?pg=<?=$pg?>" method="POST">

    <div class="row">
        <div class="form-group col-md-6">
        <label for="nomcat">Nombre de la Categoria</label>
        <input type="text" name="nomcat" id="nomcat" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label for="descat">Descripcion de la Categoria</label>
            <input type="text" name="descat" id="descat" class="form-control">
        </div>

                                <div class="form-group col-md-12">
                                <input type="hidden" name="idcat" value="<?php if($datOne &&$datOne[0]['idcat']) echo $datOne[0]['idcat']; ?>">

                                <input type="hidden" name="ope" value="save">
                                <br>
                                <input type="submit" class="form-control btn btn-dark" value="Enviar">
                            </div>
    </div>
</form>

<table id="table" class="table table-striped">
        <thead>
            <tr>
                <th>Nombre de la categoria</th>
                <th>Id del Inventario</th>
                <th>Acciones</th>
                <th></th> 
            </tr>
        </thead>
        <tbody>
            <?php if($datAll){ foreach ($datAll AS $dt){ ?>
            <tr>
                <td><?=$dt['idcat']."-".$dt['nomcat'];?></td>
                <td><?=$dt['idinv'];?></td>
                <td>
                    <a href="index.php?pg=<?=$pg;?>&idcat=<?=$dt['idcat'];?>&ope=edi" title="Editar">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                    </a>
                    <a href="index.php?pg=<?=$pg;?>&idcat=<?=$dt['idcat'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                        <i class="fa-solid fa-trash-can fa-2x"></i>
                    </a>
                </td>
            </tr>
            <?php }}?>
        </tbody>
        <thead>
            <tr>
                <th>Nombre de la categoria</th>
                <th>Id del Inventario</th>
                <th>Acciones</th>
                <th></th>
            </tr>
        </thead>

    </table>