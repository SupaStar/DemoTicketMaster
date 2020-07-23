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
        <li class="breadcrumb-item"><a href="/Vistas/ayudaPublicar.php">Ayuda para la venta de Boletos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Vender Inmueble</li>
    </ol>
</nav>
<div class="contenido">
    <h3>Vende los boletos de tu Foro a través de Ticketmaster</h3>
    <em>(* = Datos obligatorios)</em>
    <form>
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <td><strong>* Nombre del Foro</strong></td>
                <td><input id="nombreForo" required value="" class="form-control"></td>
            </tr>
            <tr>
                <td><strong>* Dirección</strong></td>
                <td><input id="direccionF" value="" class="form-control"></td>
            </tr>
            <tr>
                <td><strong>* Ciudad</strong></td>
                <td><input id="ciudadF" type="text" value="" class="form-control"></td>
            </tr>
            <tr>
                <td><strong>* Estado</strong></td>
                <td><select id="estadoF" class="custom-select" value="0">
                        <option value="0">Todo México</option>
                        <option value="1">Aguascalientes</option>
                        <option value="2">Baja California</option>
                        <option value="3">Baja California Sur</option>
                        <option value="4">Campeche</option>
                        <option value="5">Coahuila de Zaragoza</option>
                        <option value="6">Colima</option>
                        <option value="7">Chiapas</option>
                        <option value="8">Chihuahua</option>
                        <option value="9">Distrito Federal</option>
                        <option value="10">Durango</option>
                        <option value="11">Guanajuato</option>
                        <option value="12">Guerrero</option>
                        <option value="13">Hidalgo</option>
                        <option value="14">Jalisco</option>
                        <option value="15">México</option>
                        <option value="16">Michoacán de Ocampo</option>
                        <option value="17">Morelos</option>
                        <option value="18">Nayarit</option>
                        <option value="19">Nuevo León</option>
                        <option value="20">Oaxaca</option>
                        <option value="21">Puebla</option>
                        <option value="22">Querétaro</option>
                        <option value="23">Quintana Roo</option>
                        <option value="24">San Luis Potosí</option>
                        <option value="25">Sinaloa</option>
                        <option value="26">Sonora</option>
                        <option value="27">Tabasco</option>
                        <option value="28">Tamaulipas</option>
                        <option value="29">Tlaxcala</option>
                        <option value="30">Veracruz de Ignacio de la Llave</option>
                        <option value="31">Yucatán</option>
                        <option value="32">Zacatecas</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>¿Cuál es la capacidad del foro?</label></td>
                <td><input id="capacidad" type="number" value="" class="form-control"></td>
            </tr>
            <tr>
                <td><label>¿Cuántos eventos maneja aproximadamente tu foro al mes?</label></td>
                <td><input id="eventosMens" type="number" value="" class="form-control"></td>
            </tr>
            <tr>
                <td><label>¿Cuántos boletos vende aproximadamente en tu foro?</label></td>
                <td><input id="ventaBoletos" type="number" value="" class="form-control"></td>
            </tr>
            <tr>
                <td><label>Tu foro acepta:</label></td>
                <td>
                    <label>
                        <input type="checkbox" id="admisionG" value="1">Admisión General
                    </label>
                    <br>
                    <label>
                        <input type="checkbox" id="lugarEspecifico" value="1">Lugar Específico
                    </label>
                </td>
            </tr>
            <tr>
                <td><strong>* Nombre Completo:</strong></td>
                <td><input id="nombreCompleto" type="text" value="" class="form-control"></td>
            </tr>
            <tr>
                <td><strong>* Email:</strong></td>
                <td><input id="email" type="email" value="" class="form-control"></td>
            </tr>
            <tr>
                <td><label>Dirección:</label></td>
                <td><input id="direccionV" value="" class="form-control"></td>
            </tr>
            <tr>
                <td><strong>* Estado:</strong></td>
                <td>
                    <select id="estadoV" class="custom-select" value="0">
                        <option value="0">Todo México</option>
                        <option value="1">Aguascalientes</option>
                        <option value="2">Baja California</option>
                        <option value="3">Baja California Sur</option>
                        <option value="4">Campeche</option>
                        <option value="5">Coahuila de Zaragoza</option>
                        <option value="6">Colima</option>
                        <option value="7">Chiapas</option>
                        <option value="8">Chihuahua</option>
                        <option value="9">Distrito Federal</option>
                        <option value="10">Durango</option>
                        <option value="11">Guanajuato</option>
                        <option value="12">Guerrero</option>
                        <option value="13">Hidalgo</option>
                        <option value="14">Jalisco</option>
                        <option value="15">México</option>
                        <option value="16">Michoacán de Ocampo</option>
                        <option value="17">Morelos</option>
                        <option value="18">Nayarit</option>
                        <option value="19">Nuevo León</option>
                        <option value="20">Oaxaca</option>
                        <option value="21">Puebla</option>
                        <option value="22">Querétaro</option>
                        <option value="23">Quintana Roo</option>
                        <option value="24">San Luis Potosí</option>
                        <option value="25">Sinaloa</option>
                        <option value="26">Sonora</option>
                        <option value="27">Tabasco</option>
                        <option value="28">Tamaulipas</option>
                        <option value="29">Tlaxcala</option>
                        <option value="30">Veracruz de Ignacio de la Llave</option>
                        <option value="31">Yucatán</option>
                        <option value="32">Zacatecas</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>C.P.</label></td>
                <td><input id="cp" type="number" value="" class="form-control"></td>
            </tr>
            <tr>
                <td><label>Teléfono de oficina</label></td>
                <td><input id="telefonoOficina" type="number" value="" class="form-control"></td>
            </tr>
            <tr>
                <td><label>Teléfono secundario</label></td>
                <td><input id="otroTel" type="number" value="" class="form-control"></td>
            </tr>
            <tr>
                <td><label>Comentarios:</label></td>
                <td><textarea id="comentarios" value="" class="form-control"></textarea></td>
            </tr>
            </tbody>
        </table>
        <div align="center">
            <strong>La información es confidencial y será utilizada únicamente para los fines antes indicados.</strong>
            <div>
                <button id="enviar" type="button" class="btn btn-outline-primary" onclick="enviarVenderInm()">Enviar
                </button>
                <input type="reset" class="btn btn-outline-secondary" id="reset">
            </div>
        </div>
        <div id="alert" class="alert alert-success oculto" role="alert" align="center">
            <h4 class="alert-heading">Exito!</h4>
            <p>Se ha mandado tu solicitud con exito, mantente al pendiente de tu correo</p>
        </div>
        <div id="error" class="alert alert-danger oculto" role="alert" align="center">
            <h4 class="alert-heading">Error!</h4>
            <p>Las casillas marcadas en rojo son obligatorias.</p>
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
    function enviarVenderInm() {
        var nombreF, direccionF, ciudadF, estadoF, capacidadF, eventosF, boletosF;
        var adminGen = 0, lugarEs = 0, nombreC, email, direccionV, estadoV, cp, telOf, telSec, comentarios;
        nombreF = document.getElementById("nombreForo").value;
        if (nombreF == "") {
            document.getElementById("nombreForo").style.borderColor = "red";
        } else {
            document.getElementById("nombreForo").style.borderColor = "";
        }
        direccionF = document.getElementById("direccionF").value;
        if (direccionF == "") {
            document.getElementById("direccionF").style.borderColor = "red";
        } else {
            document.getElementById("direccionF").style.borderColor = "";
        }
        ciudadF = document.getElementById("ciudadF").value;
        estadoF = document.getElementById("estadoF").value;
        if (estadoF == 0) {
            document.getElementById("estadoF").style.borderColor = "red";
        } else {
            document.getElementById("estadoF").style.borderColor = "";
        }
        nombreC = document.getElementById("nombreCompleto").value;
        if (nombreC == "") {
            document.getElementById("nombreCompleto").style.borderColor = "red";
        } else {
            document.getElementById("nombreCompleto").style.borderColor = "";
        }
        email = document.getElementById("email").value;
        if (email == "") {
            document.getElementById("email").style.borderColor = "red";
        } else {
            document.getElementById("email").style.borderColor = "";
        }
        estadoV = document.getElementById("estadoV").value;
        if (estadoV == 0) {
            document.getElementById("estadoV").style.borderColor = "red";
        } else {
            document.getElementById("estadoV").style.borderColor = "";
        }
        if (nombreF == "" || direccionF == "" || estadoF == 0 || nombreC == "" || email == "" || estadoV == 0) {
            document.getElementById("error").style.display = "block";
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            return;
        }
        capacidadF = document.getElementById("capacidad").value;
        if (capacidadF !== "") {
            if (capacidadF <= 0) {
                document.getElementById("capacidad").style.borderColor = "red";
                return;
            } else {
                document.getElementById("capacidad").style.borderColor = "";
            }
        }
        eventosF = document.getElementById("eventosMens").value;
        if (eventosF !== "") {
            if (eventosF <= 0) {
                document.getElementById("eventosMens").style.borderColor = "red";
                return;
            } else {
                document.getElementById("eventosMens").style.borderColor = "";
            }
        }
        boletosF = document.getElementById("ventaBoletos").value;
        if (boletosF <= 0) {
            if (boletosF <= 0) {
                document.getElementById("ventaBoletos").style.borderColor = "red";
                return;
            } else {
                document.getElementById("ventaBoletos").style.borderColor = "";
            }
        }
        if ($('#admisionG').prop('checked')) {
            adminGen = "Admision general";
        }
        if ($('#lugarEspecifico').prop('checked')) {
            lugarEs = "Lugar Especifico";
        }
        direccionV = document.getElementById("direccionV").value;
        cp = document.getElementById("cp").value;
        if (cp !== "") {
            if (cp.length > 5 || cp <= 0) {
                document.getElementById("cp").style.borderColor = "red";
                return;
            } else {
                document.getElementById("cp").style.borderColor = "";
            }
        }
        telOf = document.getElementById("telefonoOficina").value;
        telSec = document.getElementById("otroTel").value;
        comentarios = document.getElementById("comentarios").value;
        var params = {
            "nombreF": nombreF,
            "direccionF": direccionF,
            "estadoF": estadoF,
            "nombreC": nombreC,
            "email": email,
            "estadoV": estadoV,
            "ciiudadF": ciudadF,
            "capacidadF": capacidadF,
            "eventosF": eventosF,
            "boletosF": boletosF,
            "direccionV": direccionV,
            "cp": cp,
            "telOf": telOf,
            "telSec": telSec,
            "comentarios": comentarios,
            "adminGen": adminGen,
            "lugarEs": lugarEs
        };
        $.ajax({
            data: params,
            url: '/Phps/venderInm.php',
            type: 'post',
            beforeSend: function () {
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
                }
                $('#reset').click();
                $('#enviar').removeAttr('disabled').find('div.spinner-border').remove();
            }
        });
    }
</script>
