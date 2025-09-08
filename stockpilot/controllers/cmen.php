<?php
include("models/mmen.php");

$mmen = new Mmen();
$datm = $mmen->menu($_SESSION['idper']);
?>