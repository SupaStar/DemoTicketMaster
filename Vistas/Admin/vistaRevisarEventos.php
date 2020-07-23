<html>
<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["usuario"]) && $_SESSION["rol"] == 0){
require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/dbConfig.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/Eventos/Functions.php");
$sql = "Select * from eventospendientes";
$result = $mysqli->query($sql);
?>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/head.php');
?>
<body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/header.php');
?>
<div class="contenido">
    <?php
    require_once($_SERVER["DOCUMENT_ROOT"] . '/Vistas/Modales/ModalAceptarEvento.php');
    ?>
    <div id="error" class="alert alert-danger oculto" role="alert" align="center">
        <h4 class="alert-heading">Error!</h4>
        <p>Ocurrio un error.</p>
    </div>
    <div id="alert" class="alert alert-success oculto" role="alert" align="center">
        <h4 class="alert-heading">Exito!</h4>
        <p>Peticion aceptada con exito.</p>
    </div>
    <div align="right">
        <a href="/Vistas/Admin/vistaRevisarForos.php" target="_blank">Revisar foros</a>
    </div>
    <h3 align="center">Revisar Eventos Pendientes</h3>
    <table class="table" id="tabla" data-toggle="table" data-search="true"
           data-height="500" data-show-toggle="true"
           data-page-list="[10, 25, 50, 100, all]"
           data-show-export="true" data-show-footer="true"
           data-pagination="true" data-filter="true"
           data-show-columns="true">
        <thead>
        <tr>
            <th>Acciones</th>
            <th data-sortable="true" data-escape="true">ID</th>
            <th data-sortable="true">Nombre evento</th>
            <th data-sortable="true">Fecha de venta</th>
            <th data-sortable="true">Nombre foro</th>
            <th data-sortable="true">Capacidad foro</th>
            <th data-sortable="true">Boletos a vender</th>
            <th data-sortable="true">Costo boleto</th>
            <th data-sortable="true">Taquilla</th>
            <th data-sortable="true">Admision General</th>
            <th data-sortable="true">Lugar especifico</th>
            <th data-sortable="true">Nombre completo</th>
            <th data-sortable="true">Email</th>
            <th data-sortable="true">Direccion</th>
            <th data-sortable="true">Estado</th>
            <th data-sortable="true">CP</th>
            <th data-sortable="true">Telefono casa</th>
            <th data-sortable="true">Telefono Secundario</th>
            <th data-sortable="true">Comentarios</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) {
            $fechaA = strtotime(date("Y-m-d"));
            $fechaBD = strtotime($row["fechaVenta"]);
            if ($fechaA < $fechaBD || $fechaBD < 0 || $fechaBD == false) {
                if ($row["estadoReg"] == 1) { ?>
                    <tr id="<?php echo $row["idEvPentientes"] ?>">
                        <td>
                            <button class="btn btn-success fas fa-check" type="button"
                                    data-backdrop="static"
                                    data-toggle="modal" data-target="#myModal"
                                    onclick="validar(<?php echo $row["idEvPentientes"] ?>,'<?php echo $row["fechaVenta"] ?>')"></button>
                            <button class="btn btn-danger fas fa-trash" type="button"
                                    onclick="rechazar(<?php echo $row["idEvPentientes"] ?>)"></button>
                        </td>
                        <td><?php echo $row["idEvPentientes"]; ?></td>
                        <td><?php echo $row["nombreEvento"]; ?></td>
                        <td><?php
                            if ($fechaBD > 0) {
                                echo $row["fechaVenta"];
                            } else {
                                echo "No se proporciono fecha";
                            } ?></td>
                        <td><?php if ($row["nombreForo"] == "") {
                                echo "No se especifico";
                            } else {
                                echo $row["nombreForo"];
                            } ?></td>
                        <td>
                            <?php if ($row["capacidadForo"] == 0) {
                                echo "No se especifico";
                            } else {
                                echo $row["capacidadForo"];
                            } ?>
                        </td>
                        <td>
                            <?php if ($row["boletosVender"] == 0) {
                                echo "No se especifico";
                            } else {
                                echo $row["boletosVender"];
                            } ?>
                        </td>
                        <td>
                            <?php if ($row["costoBoleto"] == 0) {
                                echo "No se especifico";
                            } else {
                                echo $row["costoBoleto"];
                            } ?>
                        </td>
                        <td>
                            <?php if ($row["taquilla"] != 0) {
                                echo "Si";
                            } else {
                                echo "No";
                            } ?>
                        </td>
                        <td>
                            <?php if ($row["admisionGeneral"] != 0) {
                                echo "Si";
                            } else {
                                echo "No aplica";
                            } ?>
                        </td>
                        <td>
                            <?php if ($row["lugarEspecifico"] != 0) {
                                echo "Si";
                            } else {
                                echo "No aplica";
                            } ?>
                        </td>
                        <td><?php echo $row["nombreCompleto"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td>
                            <?php if ($row["direccion"] == "") {
                                echo "No se especifico";
                            } else {
                                echo $row["direccion"];
                            } ?>
                        </td>
                        <td><?php
                            $estadoV = $row["estado"];
                            $estado = ciudadPais($estadoV);
                            echo $estado; ?>
                        </td>
                        <td>
                            <?php if ($row["cp"] == 0) {
                                echo "No se especifico";
                            } else {
                                echo $row["cp"];
                            } ?>
                        </td>
                        <td>
                            <?php if (!$row["telCasa"] != "") {
                                echo "No se especifico";
                            } else {
                                echo $row["telCasa"];
                            } ?>
                        </td>
                        <td>
                            <?php if (!$row["telSecundario"] != "") {
                                echo "No se especifico";
                            } else {
                                echo $row["telSecundario"];
                            } ?>
                        </td>
                        <td>
                            <?php if ($row["comentarios"] != "") {
                                echo $row["comentarios"];
                            } else {
                                echo "Ninguno";
                            }
                            ?>
                        </td>
                    </tr>
                <?php }
            }
        } ?>
        </tbody>
        <tfoot>
        <tr>
            <th>Acciones</th>
            <th>ID</th>
            <th>Nombre foro</th>
            <th>Direccion foro</th>
            <th>Ciudad Foro</th>
            <th>Estado foro</th>
            <th>Capacidad foro</th>
            <th>#Eventos foro</th>
            <th>Boletos vendidos del foro</th>
            <th>Admision General</th>
            <th>Lugar especifico</th>
            <th>Nombre completo</th>
            <th>Email</th>
            <th>Direccion del Dueño</th>
            <th>Estado del Dueño</th>
            <th>CP</th>
            <th>Telefono oficina</th>
            <th>Telefono Secundario</th>
            <th>Comentarios</th>
        </tr>
        </tfoot>
    </table>
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
    function validar(id, fecha) {
        $("#idE").val(id);
        if (fecha === "" || fecha === "0000-00-00") {
            var fechaA = $("#fechaActual").val();
            $("#fechaV").append('<tr>' +
                '<td>' +
                '<span class="input-group-text col-lg-auto">Ingresa la fecha del evento</span>' +
                '</td>' +
                '<td><input class="form-control" type="date" id="fechita" min="' + fechaA + '"></td></tr>');
        } else {
            $("#fechaV").append('<input class="form-control" type="date" id="fechita" hidden>');
            $("#fechita").val(fecha);
        }
    }
    function borrarT() {
        var id = $("#idE").val();
        $("#" + id).remove();
        document.getElementById("alert").style.display = "block";
        setTimeout(function () {
            document.getElementById("alert").style.display = "none";
        }, 7000);
        window.scrollTo(0, 0);
    }
    function rechazar(id) {
        var params = {
            "id": id,
            "funcion": 5
        };
        $.ajax({
            data: params,
            type: "Post",
            url: "/Phps/MetodosAdmin.php",
            success: function (response) {
                var json = $.parseJSON(response);
                if (json.estado) {
                    $("#" + id).remove();
                    document.getElementById("alert").style.display = "block";
                    setTimeout(function () {
                        document.getElementById("alert").style.display = "none";
                    }, 7000);
                    window.scrollTo(0, 0);
                } else {
                    document.getElementById("error").style.display = "block";
                    setTimeout(function () {
                        document.getElementById("error").style.display = "none";
                    }, 7000);
                    window.scrollTo(0, 0);
                }
            }
        });
    }
</script>
<?php
} else {
    header('location:/index.php');
}
?>