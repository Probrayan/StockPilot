<div class="pf">
    <!-- Icono usuario -->
    <div class="divpf divico1">
        <i class="fa-solid fa-user-tie"></i>
    </div>

    <!-- Nombre, apellido y rol -->
    <div class="divpf divitext">
        <?= $_SESSION['nomusu']; ?>&nbsp;
        <?= $_SESSION['apeusu']; ?><br>
        <small><?= $_SESSION['nomper']; ?></small>
    </div>

    <!-- Botón de cerrar sesión -->
    <div class="divpf divico2">
        <a href="views/vsal.php"><i class="fa-solid fa-power-off"></i></a>
    </div>
</div>
