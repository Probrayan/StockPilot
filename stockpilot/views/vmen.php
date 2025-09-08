<?php
include("controllers/cmen.php");

if ($datm) { 
    foreach ($datm as $dm) {
?>
<a href="home.php?pg=<?= $dm['idpag']; ?>">
    <i class="<?= $dm['icono']; ?>"></i> <?= $dm['nompag']; ?>
</a>
<?php 
    } 
} 
?>
