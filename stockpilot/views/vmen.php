<?php
// Incluye el controlador que obtiene los datos del menú
include("controllers/cmen.php"); 
?>

<?php if ($datm && count($datm) > 0) { ?>

<!-- Navbar (Menú Fijo y ahora con scroll interno) -->
<nav id="navbar">
    
    <!-- 1. ÍCONO PRINCIPAL (HOME / HAMBURGUESA) - POSICIÓN FIJA SUPERIOR -->
    <!-- Este elemento es AHORA TOTALMENTE INDEPENDIENTE de los datos ($datm) -->
    <div class="navbar-logo flexbox-left">
        <!-- NOTA: Se quitó el enlace <a> y se usó <div>, según tu solicitud. -->
        <div class="navbar-item-inner flexbox-left"> 
            <div class="navbar-item-inner-icon-wrapper flexbox-col">
                <!-- Usamos fa-house como ícono de Home/Dashboard -->
                <i class="fa-solid fa-house" title="Inicio"></i>
            </div>
            <span class="link-text">Inicio</span>
        </div>
    </div>

    <!-- 2. CONTENEDOR DE ÍTEMS PRINCIPALES (CON SCROLL) -->
    <div class="scrollable-menu-items">
        <!-- LISTA DE ÍTEMS PRINCIPALES (SE OCULTA EN MODO COLAPSADO POR CSS) -->
        <ul class="navbar-top-items">
            <?php 
            // CAMBIO CLAVE: Ya no se salta el primer elemento ($is_first ha sido removida).
            // Todos los ítems de la base de datos se dibujarán aquí.
            foreach ($datm as $dm) { 
                
                // Verificación del ítem activo
                // El ítem de Empresa (pg=1001) se marcará como activo si $pg es 1001 o si $pg es NULL/no está definido (línea 44 de home.php)
                $class_active = ($dm['idpag'] == $pg) ? 'active' : '';
            ?>
                <!-- Ítem Dinámico del Menú -->
                <li class="navbar-item flexbox-left <?= $class_active; ?>">
                    <a class="navbar-item-inner flexbox-left" href="home.php?pg=<?= $dm['idpag']; ?>">
                        <div class="navbar-item-inner-icon-wrapper flexbox-col">
                            <i class="<?= $dm['icopag']; ?>"></i>
                        </div>
                        <!-- Nombre de la página, visible solo al expandir -->
                        <span class="link-text"><?= $dm['nompag']; ?></span>
                    </a>
                </li>
            <?php 
            } 
            ?>
        </ul>
    </div>
    
    <!-- 3. ÍTEMS INFERIORES (SIEMPRE VISIBLES Y ADHERIDOS AL FONDO) - POSICIÓN FIJA INFERIOR -->
    <ul class="navbar-bottom-items"> 
        
        <!-- Ítem Fijo para Perfil (visible en modo colapsado) -->
        <li class="navbar-item flexbox-left <?= ($pg==2000) ? 'active' : ''; ?>">
            <a class="navbar-item-inner flexbox-left" href="home.php?pg=2000">
                <div class="navbar-item-inner-icon-wrapper flexbox-col">
                    <i class="fa-solid fa-user"></i> 
                </div>
                <span class="link-text">Mi Perfil</span>
            </a>
        </li>
        
        <!-- Ítem Fijo para Salir (visible en modo colapsado) -->
        <li class="navbar-item flexbox-left">
            <a class="navbar-item-inner flexbox-left" href="models/logout.php">
                <div class="navbar-item-inner-icon-wrapper flexbox-col">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
                <span class="link-text">Cerrar Sesión</span>
            </a>
        </li>
    </ul>
</nav>

<?php } ?>