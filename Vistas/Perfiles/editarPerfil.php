<html>
<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["usuario"])){
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/head.php');
?>
<body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/header.php');
?>
<div class="contenido">
    <?php
    require_once($_SERVER["DOCUMENT_ROOT"] . '/Phps/dbConfig.php');
    $id = $_SESSION["usuario"];
    $sqlu = "select nombre,apMaterno,apPaterno,correo from usuarios WHERE id='$id'";
    $usuario = $mysqli->query($sqlu);
    $nombre = "";
    $apPat = "";
    $apMat = "";
    $correo = "";
    foreach ($usuario as $rowsita) {
        $nombre = $rowsita["nombre"];
        $apPat = $rowsita["apPaterno"];
        $apMat = $rowsita["apMaterno"];
        $correo = $rowsita["correo"];
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
    ?>
    <div id="alert" class="alert alert-success oculto" role="alert">
        <h4 class="alert-heading">Exito!</h4>
        <p id="msjAlert"></p>
    </div>
    <div id="error" class="alert alert-danger oculto" role="alert">
        <h4 class="alert-heading">Error!</h4>
        <p id="msjE"></p>
    </div>
    <div class="menuEditar">
        <ul class="sinMargin">
            <li>
                <h4 class="sinMargin">Perfil de cuenta</h4>
            </li>
        </ul>
        <div class="tab-body shadow-lg p-3 mb-5 bg-white rounded">
            <form>
                <table>
                    <tr>
                        <td><label for="nombre">Nombre(s):</label></td>
                        <td><input class="form-control" id="nombre" value="<?php echo $nombre; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="apPat">Apellido paterno:</label></td>
                        <td><input class="form-control" id="apPat" value="<?php echo $apPat; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="apMat">Apellido materno:</label></td>
                        <td><input class="form-control" id="apMat" value="<?php echo $apMat; ?>"></td>
                    </tr>
                </table>
            </form>
            <div align="right">
                <button id="datosP" type="button" class="btn btn-primary" onclick="datosP()">Guardar</button>
            </div>
        </div>
    </div>
    <div class="menuEditar">
        <ul class="sinMargin">
            <li>
                <h4 class="sinMargin">Modificar tu dirección de correo electrónico</h4>
            </li>
        </ul>
        <div class="tab-body shadow-lg p-3 mb-5 bg-white rounded">
            <form>
                <table>
                    <tr>
                        <td><label>Correo electronico:</label></td>
                        <td><label id="correoE"><?php echo $correo; ?></td>
                    </tr>
                    <tr>
                        <td><label for="nEmail">Nueva dirección de correo electrónico:</label></td>
                        <td><input class="form-control" id="nEmail" type="email"></td>
                    </tr>
                    <tr>
                        <td><label for="rnEmail">Escribe otra vez tu nueva dirección de correo electrónico:</label></td>
                        <td><input class="form-control" id="rnEmail" type="email"></td>
                    </tr>
                </table>
            </form>
            <div align="right">
                <button id="correito" type="button" class="btn btn-primary" onclick="correo()">Enviar</button>
            </div>
        </div>
    </div>
    <div class="menuEditar">
        <ul class="sinMargin">
            <li>
                <h4 class="sinMargin">Editar contraseña</h4>
            </li>
        </ul>
        <div class="tab-body shadow-lg p-3 mb-5 bg-white rounded">
            <form>
                <table>
                    <tr>
                        <td><label for="contA">Contraseña anterior:</label></td>
                        <td><input class="form-control" id="contA" type="password"></td>
                    </tr>
                    <tr>
                        <td><label for="nPass">Nueva contraseña:</label></td>
                        <td><input class="form-control" id="nPass" type="password"></td>
                    </tr>
                    <tr>
                        <td><label for="rnPass">Vuelve a escribir tu nueva Contraseña:</label></td>
                        <td><input class="form-control" id="rnPass" type="password"></td>
                    </tr>
                </table>
            </form>
            <div align="right">
                <button id="pass" onclick="password()" type="button" class="btn btn-primary">Enviar</button>
            </div>
        </div>
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
<script>
    function datosP() {
        var nombre = $("#nombre").val();
        var apPat = $("#apPat").val();
        var apMat = $("#apMat").val();
        var params = {
            "nombre": nombre,
            "apPat": apPat,
            "apMat": apMat,
            "funcion": 1
        };
        $.ajax({
            data: params,
            type: "post",
            url: "/Phps/Perfil/editar.php",
            beforeSend: function () {
                $('#datosP').attr('disabled', 'disabled').prepend('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div>');
            },
            success: function (response) {
                var json = $.parseJSON(response);
                if (json.estado) {
                    $('#datosP').removeAttr('disabled').find('div.spinner-border').remove();
                    $("#msjAlert").empty();
                    $("#msjAlert").append("Datos cambiados con exito");
                    document.getElementById("alert").style.display = "block";
                    setTimeout(function () {
                        document.getElementById("alert").style.display = "none";
                    }, 7000);
                    window.scrollTo(0, 0);
                } else {
                    $('#datosP').removeAttr('disabled').find('div.spinner-border').remove();
                    $("#msjE").empty();
                    $("#msjE").append("Error al actualizar tus datos");
                    document.getElementById("error").style.display = "block";
                    setTimeout(function () {
                        document.getElementById("error").style.display = "none";
                    }, 7000);
                    window.scrollTo(0, 0);
                }
            }
        });
    }
    function correo() {
        var correo = $("#nEmail").val();
        var rcorreo = $("#rnEmail").val();
        if (correo !== rcorreo) {
            $("#msjE").empty();
            $("#msjE").append("Los correos no coinciden");
            document.getElementById("error").style.display = "block";
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
        } else {
            var params = {
                "funcion": 2,
                "correo": correo
            };
            $.ajax({
                data: params,
                type: "post",
                url: "/Phps/Perfil/editar.php",
                beforeSend: function () {
                    $('#correito').attr('disabled', 'disabled').prepend('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div>');
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.estado) {
                        $('#correito').removeAttr('disabled').find('div.spinner-border').remove();
                        $("#msjAlert").empty();
                        $("#msjAlert").append("Correo actualizado con exito.");
                        document.getElementById("alert").style.display = "block";
                        setTimeout(function () {
                            document.getElementById("alert").style.display = "none";
                        }, 7000);
                        $("#nEmail").val("");
                        $("#rnEmail").val("");
                        $("#correoE").empty();
                        $("#correoE").append(correo);
                        window.scrollTo(0, 0);
                    } else {
                        $('#correito').removeAttr('disabled').find('div.spinner-border').remove();
                        $("#msjE").empty();
                        $("#msjE").append("Error al actualizar tu correo, puede que el correo nuevo ya este en uso");
                        document.getElementById("error").style.display = "block";
                        setTimeout(function () {
                            document.getElementById("error").style.display = "none";
                        }, 7000);
                        window.scrollTo(0, 0);
                    }
                }
            });
        }
    }
    function password() {
        var passA = $("#contA").val();
        var passN = $("#nPass").val();
        var passrN = $("#rnPass").val();
        if (passrN.length <= 0 || passrN.length <= 0) {
            $("#msjE").empty();
            $("#msjE").append("La contraseña debe tener minimo 8 caracteres");
            document.getElementById("error").style.display = "block";
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
            return;
        }
        if (passN !== passrN) {
            $("#msjE").empty();
            $("#msjE").append("La nueva contraseña no coincide");
            document.getElementById("error").style.display = "block";
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
        } else {
            var params = {
                "funcion": 3,
                "passA": passA,
                "passN": passrN
            };
            $.ajax({
                data: params,
                type: "post",
                url: "/Phps/Perfil/editar.php",
                beforeSend: function () {
                    $('#pass').attr('disabled', 'disabled').prepend('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div>');
                },
                success: function (response) {
                    var json = $.parseJSON(response);
                    if (json.estado) {
                        $('#pass').removeAttr('disabled').find('div.spinner-border').remove();
                        $("#msjAlert").empty();
                        $("#msjAlert").append("Contraseña actualizada con exito.");
                        document.getElementById("alert").style.display = "block";
                        setTimeout(function () {
                            document.getElementById("alert").style.display = "none";
                        }, 7000);
                        $("#nPass").val("");
                        $("#rnPass").val("");
                        $("#contA").val("");
                        window.scrollTo(0, 0);
                    } else {
                        $('#pass').removeAttr('disabled').find('div.spinner-border').remove();
                        $("#msjE").empty();
                        $("#msjE").append("Error al actualizar tu contraseña,revisa que los datos sean correctos");
                        document.getElementById("error").style.display = "block";
                        setTimeout(function () {
                            document.getElementById("error").style.display = "none";
                        }, 7000);
                        window.scrollTo(0, 0);
                    }
                }
            });
        }
    }
</script>
<?php
} else {
    header('location:/index.php');
}
?>