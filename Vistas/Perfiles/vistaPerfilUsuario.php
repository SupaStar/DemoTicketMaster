<html>
<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["usuario"]) && $_SESSION["rol"] == 1){
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
    $id = $_SESSION["usuario"];
    require_once($_SERVER["DOCUMENT_ROOT"] . '/Phps/dbConfig.php');
    require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/Eventos/Functions.php");
    $sql = "select nombre,apMaterno,apPaterno,correo from usuarios WHERE id='$id'";
    $usuario = $mysqli->query($sql);
    $sqlEvP = "SELECT
    boletoscomp.fechaCompra,
    boletos.costoB,
    eventosaceptados.nombreEv,
    eventosaceptados.fechaVenta,
    forosaceptados.nombreF,
    forosaceptados.direccionF,
    forosaceptados.ciudadF,
    forosaceptados.estadoF
FROM
    boletoscomp
INNER JOIN boletos ON boletoscomp.idBoletos = boletos.idBoletos
INNER JOIN eventosaceptados ON boletos.idEv = eventosaceptados.idEv
INNER JOIN forosaceptados ON eventosaceptados.idForo = forosaceptados.idF
WHERE
    idUsu = '$id'
    ORDER BY
    boletoscomp.idBC
DESC
    limit 5 ";
    $eventosP = $mysqli->query($sqlEvP);
    $eventosPA = [];
    foreach ($eventosP as $eventico) {
        $evento = [
            "fechaC" => $eventico["fechaCompra"],
            "costoB" => $eventico["costoB"],
            "nombreE" => $eventico["nombreEv"],
            "fechaV" => $eventico["fechaVenta"],
            "nombreF" => $eventico["nombreF"],
            "direccionF" => $eventico["direccionF"],
            "ciudadF" => $eventico["ciudadF"],
            "estadoF" => $eventico["estadoF"]
        ];
        array_push($eventosPA, $evento);
    }
    foreach ($usuario as $row) {
        ?>
        <table class="tablitainfo">
            <tr class="titulito">
                <td><h1 class="tituloPerfiles">Mi Cuenta</h1></td>
                <td class="separador">
                    <h5>Bienvenido <?php echo $row["nombre"] . " " . $row["apMaterno"] . " " . $row["apPaterno"]; ?>
                    </h5>
                    <a href="/Vistas/Perfiles/editarPerfil.php">Editar perfil</a>
                    |
                    <a href="/Phps/Eventos/cerrarSesion.php">Cerrar sesion.</a>
                </td>
            </tr>
        </table>
    <?php } ?>
    <div>
        <div>
            <div><strong>Mis eventos pasados</strong>
                <?php
                if (!empty($eventosPA)) {
                    ?>
                    <table class="table tablitaIndx table-hover">
                        <?php
                        foreach ($eventosPA as $evento) {
                            ?>
                            <tr>
                                <td>
                                    <div>
                                        <label><strong>Evento:</strong> <?php echo $evento["nombreE"]; ?></label>
                                        <p><strong>Fecha de compra:</strong> <?php echo $evento["fechaC"]; ?></p>
                                        <p><strong>Costo de boleto:</strong><?php echo $evento["costoB"] ?></p>
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
                        ?>
                    </table>
                    <?php
                } else {
                    echo "No has asistido a algún evento.";
                }
                ?>
            </div>
            <div>
            </div>
        </div>
    </div>

</div>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/footer.php');
?>
</body>
</html>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/scripts.php');
?>
<script>

</script>
<?php
} else {
    header('location:/index.php');
}
?>