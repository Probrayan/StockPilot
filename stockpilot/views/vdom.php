<?php
require_once('controllers/cdom.php');
?>
<h2>Dominio</h2><i class="fa-solid fa-globe"></i>



<form action="home.php?pg=<?=$pg?>" method="POST">

    <div class="row">
        <div class="form-group col-md-6">
            <label for="nomdom">Nombre del dominio</label>
            <input type="text" name="nomdom" id="nomdom" class="form-control" value="<?php if($datOne && $datOne[0]['nomdom']) echo $datOne[0]['nomdom'];?>">
        </div>

        <div class="form-group col-md-6">
            <input type="hidden" name="iddom" value="<?php if($datOne && $datOne[0]['iddom']) echo $datOne[0]['iddom'];?>">
            <input type="hidden" name="ope" value="save">
            <br>
            <input type="submit" class="form-control btn btn-dark" value="Enviar">
        </div>
    </div>
</form>

<table id="example" class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre del Dominio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if($datAll){ foreach ($datAll AS $dt){ ?>
            <tr>
                <td><?=$dt['iddom'];?></td>
                <td><?=$dt['nomdom'];?></td>
                <td>
<a href="index.php?pg=<?=$pg;?>&iddom=<?=$dt['iddom'];?>&ope=edi" title="Editar">
    <i class="fa-solid fa-pen-to-square fa-2x"></i>
</a>
                <a href="index.php?pg=<?=$pg;?>&iddom=<?=$dt['iddom'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                    <i class="fa-solid fa-trash-can fa-2x"></i>
                </a>

                </td>
            </tr>
            <?php }}?>
        </tbody>


        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre del Dominio</th>
                <th></th>
            </tr>
        </thead>
