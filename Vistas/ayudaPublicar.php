<html>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/head.php');
?>
<body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/header.php');
?>
<nav aria-label="breadcrumb" class="padBod">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ayuda para la venta de Boletos</li>
    </ol>
</nav>
<div class="contenido">
    <span>Este espacio es para ti promotor o foro interesado en vender tu evento a través del sistema Ticketmaster</span>
    <li>Si deseas publicar tu evento <a href="/Vistas/ManagerInmueble/venderEvento.php">haz click aqui.</a></li>
    <li>Si representas un foro o inmueble <a href="/Vistas/ManagerInmueble/venderInmueble.php">haz click aqui.</a></li>
</div>
</body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/footer.php');
?>
</html>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/scripts.php');
?>