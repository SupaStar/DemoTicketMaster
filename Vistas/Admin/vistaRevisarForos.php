<html>
<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["usuario"]) && $_SESSION["rol"] == 0){
require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/dbConfig.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/Eventos/Functions.php");
$sql = "Select * from forospendientes";
$result = $mysqli->query($sql);
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/head.php');
?>
<body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/header.php');
?>
<div class="contenido">
    <div align="right">
        <a href="/Vistas/Admin/vistaRevisarEventos.php" target="_blank">Revisar eventos</a>
    </div>
    <h3 align="center">Revisar Foros Pendientes</h3>
    <div id="error" class="alert alert-danger oculto" role="alert" align="center">
        <h4 class="alert-heading">Error!</h4>
        <p>Ocurrio un error, intentalo mas tarde.</p>
    </div>
    <div id="alert" class="alert alert-success oculto" role="alert" align="center">
        <h4 class="alert-heading">Exito!</h4>
        <p>Se ha mandado la imagen correctamente</p>
    </div>
    <?php
    require_once($_SERVER["DOCUMENT_ROOT"] . '/Vistas/Modales/ModalAceptarForo.php');
    ?>
    <input id="idT" hidden>
    <input id="dir" hidden>
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
            <th data-sortable="true">Nombre foro</th>
            <th data-sortable="true">Direccion foro</th>
            <th data-sortable="true">Ciudad Foro</th>
            <th data-sortable="true">Estado foro</th>
            <th data-sortable="true">Capacidad foro</th>
            <th data-sortable="true">#Eventos foro</th>
            <th data-sortable="true">Boletos vendidos del foro</th>
            <th data-sortable="true">Admision General</th>
            <th data-sortable="true">Lugar especifico</th>
            <th data-sortable="true">Nombre completo</th>
            <th data-sortable="true">Email</th>
            <th data-sortable="true">Direccion del Dueño</th>
            <th data-sortable="true">Estado del Dueño</th>
            <th data-sortable="true">CP</th>
            <th data-sortable="true">Telefono oficina</th>
            <th data-sortable="true">Telefono Secundario</th>
            <th data-sortable="true">Comentarios</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) {
            if ($row["estado"] == 1) {
                ?>
                <tr id="<?php echo $row["idInmP"] ?>">
                    <td>
                        <button class="btn btn-success fas fa-check" type="button"
                                data-toggle="modal" data-target="#myModal"
                                data-backdrop="static"
                                onclick="validar(<?php echo $row["idInmP"] ?>)"></button>
                        <button class="btn btn-danger fas fa-trash" type="button"
                                onclick="rechazar(<?php echo $row["idInmP"] ?>)"></button>
                    </td>
                    <td><?php echo $row["idInmP"]; ?></td>
                    <td><?php echo $row["nombreForo"]; ?></td>
                    <td><?php echo $row["direccionForo"]; ?></td>
                    <td><?php echo $row["ciudadForo"]; ?></td>
                    <td><?php
                        $estadof = $row["estadoForo"];
                        $estado = ciudadPais($estadof);
                        echo $estado; ?>
                    </td>
                    <td>
                        <?php if ($row["capacidadForo"] == 0) {
                            echo "No se especifico";
                        } else {
                            echo $row["capacidadForo"];
                        } ?>

                    </td>
                    <td>
                        <?php if ($row["eventosForo"] == 0) {
                            echo "No se especifico";
                        } else {
                            echo $row["eventosForo"];
                        } ?>
                    </td>
                    <td>
                        <?php if ($row["boletosForo"] == 0) {
                            echo "No se especifico";
                        } else {
                            echo $row["boletosForo"];
                        } ?>

                    </td>
                    <td>
                        <?php if ($row["adminGeneral"] == 1) {
                            echo "Si";
                        } else {
                            echo "No";
                        } ?>
                    </td>
                    <td>
                        <?php if ($row["lugarE"] == 1) {
                            echo "Si";
                        } else {
                            echo "No";
                        } ?>
                    </td>
                    <td>
                        <?php echo $row["nombreCompleto"]; ?>
                    </td>
                    <td>
                        <?php if ($row["email"] != "") {
                            echo $row["email"];
                        } else {
                            echo "No se especifico";
                        } ?>

                    </td>
                    <td>
                        <?php if ($row["direccionVend"] != "") {
                            echo $row["direccionVend"];
                        } else {
                            echo "No se especifico";
                        } ?>
                    </td>
                    <td>
                        <?php
                        $estadoV = $row["estadoForo"];
                        $estadoVe = ciudadPais($estadoV);
                        echo $estadoVe;
                        ?>
                    </td>
                    <td>
                        <?php if ($row["cp"] != 0) {
                            echo $row["cp"];
                        } else {
                            echo "No se especifico";
                        } ?>
                    </td>
                    <td>
                        <?php if ($row["telefonoOf"] != "") {
                            echo $row["telefonoOf"];
                        } else {
                            echo "No se especifico";
                        } ?>
                    </td>
                    <td>
                        <?php if ($row["telefonoSec"] != "") {
                            echo $row["telefonoSec"];
                        } else {
                            echo "No se especifico";
                        } ?>
                    </td>
                    <td>
                        <?php if ($row["comentarios"] != "") {
                            echo $row["comentarios"];
                        } else {
                            echo "Ninguno";
                        } ?>
                    </td>
                </tr>
            <?php }
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
    function validar(id) {
        $("#idF").val(id);
    }
    function ejecutarAceptacion(secciones) {
        var id = $("#idT").val();
        var direc = $("#dir").val();
        var pass = $("#passV").val();
        var params = {
            'id': id,
            'funcion': 1,
            'directorio': direc,
            'password': pass,
            'secciones': secciones
        };
        $.ajax({
            data: params,
            url: "/Phps/MetodosAdmin.php",
            type: 'post',
            success: function (response) {
                var json = $.parseJSON(response);
                if (json.estado) {
                    $("#passV").val("");
                    $("#" + id).remove();
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
    function rechazar(id) {
        var params = {
            'id': id,
            'funcion': 2
        };
        $.ajax({
            data: params,
            url: "/Phps/MetodosAdmin.php",
            type: 'post',
            success: function (response) {
                var json = $.parseJSON(response);
                if (json.estado) {
                    $("#" + id).remove();
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