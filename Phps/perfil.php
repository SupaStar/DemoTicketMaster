<?php
$status=session_status();
if ($status == PHP_SESSION_NONE){
    session_start();
}
switch ($_SESSION["rol"]){
    case 0:
        header('location:/Vistas/Admin/vistaRevisarEventos.php');
        break;
    case 1:
        header('location:/Vistas/Perfiles/vistaPerfilUsuario.php');
        break;
    case 2:
        header('location:/Vistas/Perfiles/vistaPerfilVendedor.php');
        break;
}
?>