<html>
<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["usuario"])){
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/head.php');
?>
<body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/header.php');
?>
<nav aria-label="breadcrumb" class="padBod">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Registro</li>
    </ol>
</nav>
<div class="contenido">
    <div class="container">
        <h2 class="text-center">Registro</h2>
    </div>
    <form>
        <div id="error" class="alert alert-danger oculto" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <p id="msjE"></p>
        </div>
        <div  class="alert alert-secondary" role="alert">
            <span>Los campos con * son obligatorios.</span>
        </div>
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <td>
                    <div>
                        <span class="input-group-text">Introduce tu nombre(s)*:</span>
                    </div>
                </td>
                <td class="inputsReg">
                    <input id="nombre" type="text" required class="form-control" aria-label="Nombre"
                           aria-describedby="inputGroup-sizing-sm">
                </td>
            </tr>
            <tr>
                <td>
                    <span class="input-group-text">Apellido paterno</span>
                </td>
                <td>
                    <input id="apPaterno" type="text" required aria-label="Introduce tu apellido paterno"
                           class="form-control">
                </td>
            </tr>
            <tr>
                <td><span class="input-group-text">Apellido materno</span></td>
                <td><input id="apMaterno" type="text" required aria-label="Introduce tu apellido materno"
                           class="form-control">
                </td>
            </tr>
            <tr>
                <td><span class="input-group-text">Introduce tu correo electronico *:</span></td>
                <td>
                    <input id="correo" type="email" required class="form-control" aria-label="Correo"
                           aria-describedby="inputGroup-sizing-sm">
                </td>
            </tr>
            <tr>
                <td><span class="input-group-text">Introduce tu contraseña *:</span></td>
                <td>
                    <input id="password" required type="password" class="form-control" aria-label="Contraseña"
                           aria-describedby="inputGroup-sizing-sm">
                </td>
            </tr>
            <tr>
                <td><span class="input-group-text">Repite tu contraseña *:</span></td>
                <td>
                    <input id="rpassword" type="password" class="form-control" aria-label="RContraseña"
                           aria-describedby="inputGroup-sizing-sm">
                </td>
            </tr>
            </tbody>
        </table>
        <div align="center">
            <button id="enviar" class="btn btn-primary btn-lg btn-block" onclick="registroUsu()" type="button">Registrarse</button>
            <input type="reset" class="btn btn-secondary btn-lg btn-block">
            <div class="dropdown-divider"></div>
            <a href="/Vistas/vistaLogin.php" class="dropdown-item">¿Ya te has registrado? Haz click aqui para iniciar
                sesion.</a>
        </div>
        <div id="alert" class="alert alert-success oculto" role="alert">
            <h4 class="alert-heading">Exito!</h4>
            <p>Te has registrado con exito,ahora puedes iniciar sesion</p>
        </div>
    </form>

</div>
</body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/footer.php');
?>
</html>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/scripts.php');
?>
<script>
    function registroUsu() {
        var mensajeE=$("#msjE");
        var nombre,correo;
        nombre=document.getElementById("nombre").value;
        if(nombre===""){
            mensajeE.empty();
            mensajeE.append("Debes colocar tu nombre.");
            document.getElementById("error").style.display = "block";
            $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
            return;
        }
        correo=document.getElementById("correo").value;
        if (correo===""){
            mensajeE.empty();
            mensajeE.append("Debes colocar tu correo electronico.");
            document.getElementById("error").style.display = "block";
            $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
            return;
        }
        var password = document.getElementById("password").value,
            rpasword = document.getElementById("rpassword").value;
        if (password.length < 8 || rpasword.length < 8) {
            mensajeE.empty();
            mensajeE.append("La contraseña debe tener minimo 8 caracteres.");
            document.getElementById("error").style.display = "block";
            $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
            return;
        }
        if (password !== rpasword) {
            mensajeE.empty();
            mensajeE.append("Las contraseñas deben coincidir");
            document.getElementById("error").style.display = "block";
            $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
        } else {
            var parametros = {
                "nombre": nombre,
                "apPaterno": document.getElementById("apPaterno").value,
                "apMaterno": document.getElementById("apMaterno").value,
                "correo": correo,
                "password": password
            };
            $.ajax({
                data: parametros,
                url: '/Phps/registro.php',
                type: 'post',
                beforeSend: function () {
                    $('#rpassword').popover('dispose');
                    $('#enviar').attr('disabled', 'disabled').prepend('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div>');
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.estado) {
                        document.getElementById("alert").style.display = "block";
                        $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
                        setTimeout(function () {
                            document.getElementById("alert").style.display = "none";
                        }, 7000);
                        limpiarReg();
                    } else {
                        mensajeE.empty();
                        mensajeE.append("Ah ocurrido un error al registrarte");
                        document.getElementById("error").style.display = "block";
                        $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
                        setTimeout(function () {
                            document.getElementById("error").style.display = "none";
                        }, 7000);
                    }
                }
            });
        }
    }
    function limpiarReg() {
        document.getElementById("nombre").value = "";
        document.getElementById("apPaterno").value = "";
        document.getElementById("apMaterno").value = "";
        document.getElementById("correo").value = "";
        document.getElementById("password").value = "";
        document.getElementById("rpassword").value = "";
    }
</script>
<?php }
else {
    header('location:/index.php');
} ?>