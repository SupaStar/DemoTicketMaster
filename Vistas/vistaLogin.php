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
        <li class="breadcrumb-item active" aria-current="page">Login</li>
    </ol>
</nav>
<div class="contenido">
    <div id="error" class="alert alert-danger oculto" role="alert" align="center">
        <h4 class="alert-heading">Error!</h4>
        <p id="msjE"></p>
    </div>
    <div class="container">
        <h2 class="text-center">Login</h2>
    </div>
    <form class="px-4 py-3">
        <div class="form-group">
            <label for="Correo">Correo electronico</label>
            <input id="correoelec" type="email" class="form-control" placeholder="email@example.com">
        </div>
        <div class="form-group">
            <label for="Contraseña">Contraseña</label>
            <input id="password" type="password" class="form-control" placeholder="Introduce tu contraseña">
        </div>
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="dropdownCheck">
                <label class="form-check-label" for="dropdownCheck">
                    Recuerdame
                </label>
            </div>
        </div>
        <button type="button" onClick="prueba()" class="btn btn-primary">Inicia sesion</button>
        <input type="reset" class="btn btn-secondary">
    </form>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="/Vistas/vistaRegistro.php">Nuevo aqui? Crea una cuenta</a>
</div>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/footer.php');
?>
</body>
</html>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/scripts.php');
?>
<script type="text/javascript">
    function prueba() {
        var correoelec = document.getElementById("correoelec").value;
        var password = document.getElementById("password").value;
        var param = {
            "correo": correoelec,
            "contra": password
        };
        $.ajax({
            data: param,
            url: "/Phps/login.php",
            type: "post",
            success: function (response) {
                var json = $.parseJSON(response);
                if (json.estado) {
                    window.location = "/index.php";
                } else {
                    $("#msjE").empty();
                    $("#msjE").append(json.detalle);
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
<?php }
else {
    header('location:/index.php');
} ?>