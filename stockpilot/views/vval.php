<?php
require_once('controllers/cval.php');
?>
<h2>Valor</h2><i class="fa--solid fa-money-bill"></i>


<form action="home.php?pg=<?=$pg;?>" method="POST">

    <div class="row">
        <div class="form-group col-md-6">
            <label for="nomval">Nombre del Valor</label>
            <input type="text" name="nomval" id="nomval" class="form-control"  value="<?php if($datOne && $datOne[0]['nomval']) echo $datOne[0]['nomval']; ?>" required>
        </div>

                <div class="form-group col-md-6">
                    <label for="iddom">Nombre del dominio</label>
                    <select name="iddom" id="iddom" class= "form-control form-select">
                    <?php if($datDom){ foreach($datDom AS $dd){ ?>
                    <option value="<?=$dd['iddom']; ?>" <?php if($datOne && $datOne[0]['iddom']==$dd['iddom']) echo "selected"; ?>required><?=$dd['nomdom'];?> </option>
                    <?php }} ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                <label for="codval">Codigo del valor</label>
                <input type="text" name="codval" id="codval" class="form-control" value="<?php if($datOne && $datOne[0]['codval']) echo $datOne[0]['codval']; ?>" required>
                </div>

                        <div class="form-group col-md-6">
                            <label for="fec_crea">Fecha de creación</label>
                            <input type="date" name="fec_crea" id="fec_crea" class="form-control" value="<?php if($datOne && $datOne[0]['fec_crea']) echo $datOne[0]['fec_crea']; ?>" required>
                        </div>

                            <div class="form-group col-md-12">
                            <input type="hidden" name="idval" value="<?php if($datOne &&$datOne[0]['idval']) echo $datOne[0]['idval']; ?>">

                            <input type="hidden" name="ope" value="save">
                                <br>
                            <input type="submit" class="form-control btn btn-dark" value="Enviar">
                            </div>
    </div>    
</form>

<table id="table" class="table table-striped">
        <thead>
            <tr>
                <th>Id y Nombre del valor</th>
                <th>Id del dominio y nombre del domino</th>
                <th>Codigo del valor</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>
                <th></th> 
            </tr>
        </thead>
        <tbody>
            <?php if($datAll){ foreach ($datAll AS $dt){ ?>
            <tr>
                <td><?=$dt['idval']."-".$dt['nomval'];?></td>
                <td><?=$dt['iddom'];?></td>
                <td><?=$dt['codval'];?></td>
                <td><?=$dt['fec_crea'];?></td>
                <td>
                    <a href="home.php?pg=<?=$pg;?>&idval=<?=$dt['idval'];?>&ope=edi" title="Editar">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                    </a>
                    <a href="home.php?pg=<?=$pg;?>&idval=<?=$dt['idval'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                        <i class="fa-solid fa-trash-can fa-2x"></i>
                    </a>
                </td>
            </tr>
            <?php }}?>
        </tbody>
        <thead>
            <tr>
                <th>Id y Nombre del valor</th>
                <th>Id del dominio</th>
                <th>Codigo del valor</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>
                <th></th>   
                <th></th> 
            </tr>
        </thead>

    </table>

