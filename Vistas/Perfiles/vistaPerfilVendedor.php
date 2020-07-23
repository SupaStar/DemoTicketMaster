<html>
<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["usuario"]) && $_SESSION["rol"] == 2){
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/head.php');
?>
<body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/header.php');
?>
<nav aria-label="breadcrumb" class="padBod" style="padding-bottom: 0px">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
    </ol>
</nav>
<div class="contenido">
    <?php
    require_once($_SERVER["DOCUMENT_ROOT"] . '/Phps/dbConfig.php');
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/Eventos/Functions.php");
    $id = $_SESSION["usuario"];
    $sqlu = "select nombre,apMaterno,apPaterno,correo from usuarios WHERE id='$id'";
    $usuario = $mysqli->query($sqlu);
    foreach ($usuario as $rowsita) {
        ?>
        <table class="tablitainfo">
            <tr class="titulito">
                <td><h1 class="tituloPerfiles">Mi Cuenta</h1></td>
                <td class="separador">
                    <h5>
                        Bienvenido <?php echo $rowsita["nombre"] . " " . $rowsita["apMaterno"] . " " . $rowsita["apPaterno"]; ?>
                    </h5>
                    <a href="/Vistas/Perfiles/editarPerfil.php">Editar perfil</a>
                    |
                    <a href="/Phps/Eventos/cerrarSesion.php">Cerrar sesion.</a>
                </td>
            </tr>
        </table>
        <?php
    }
    $sql = "SELECT
    eventosaceptados.nombreEv,
    eventosaceptados.fechaVenta,
    forosaceptados.nombreF,
    forosaceptados.direccionF,
    forosaceptados.ciudadF,
    forosaceptados.estadoF
FROM
    eventosaceptados
INNER JOIN forosaceptados ON eventosaceptados.idForo = forosaceptados.idF
WHERE
    eventosaceptados.idVendedor = '$id' OR forosaceptados.idVendedor = '$id'
    limit 5";
    $result = $mysqli->query($sql);
    $totalFilas = $result->num_rows;
    $eventos = [];
    $fechaA = strtotime(date("Y-m-d"));
    if ($totalFilas > 0) {
        foreach ($result as $row) {
            $fechaBD = strtotime($row["fechaVenta"]);
            if ($fechaA < $fechaBD) {
                $evento = [
                    "nombreE" => $row["nombreEv"],
                    "fechaV" => $row["fechaVenta"],
                    "nombreF" => $row["nombreF"],
                    "direccionF" => $row["direccionF"],
                    "ciudadF" => $row["ciudadF"],
                    "estadoF" => $row["estadoF"]];
                array_push($eventos, $evento);
            }
        }
    }
    ?>
    <div>
        <div><strong>Eventos vendidos proximos</strong></div>
        <table class="table tablitaIndx table-hover">
            <?php
            if (!empty($eventos)) {
                foreach ($eventos as $evento) {
                    ?>
                    <tr>
                        <td>
                            <div>
                                <label><strong>Evento:</strong> <?php echo $evento["nombreE"]; ?></label>
                                <p><strong>Fecha:</strong> <?php echo $evento["fechaV"]; ?></p>
                                <address>
                                    <strong>Foro:</strong> <?php echo $evento["nombreF"]; ?>
                                    <br>
                                    <strong>Direccion:</strong>
                                    <?php echo $evento["direccionF"] . ', ' . $evento["ciudadF"] . ', ' . ciudadPais($evento["estadoF"]); ?>
                                </address>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/footer.php');
?>
</body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/scripts.php');
?>
</html>
<?php
} else {
    header('location:/index.php');
}
?>