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
        <li class="breadcrumb-item active" aria-current="page">Vender Evento</li>
    </ol>
</nav>
<div class="contenido">
    <h3>Vende los boletos de tu evento a traves de TicketMaster</h3>
    <em>(* = Datos obligatorios)</em>
    <form>
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <td><strong>* ¿Cuál es el nombre del evento o artista a presentar?</strong></td>
                <td><input id="nombreEv" required class="form-control"></td>
            </tr>
            <tr>
                <td><label>¿Cuándo planeas iniciar la venta de tu evento?</label></td>
                <td><input id="fechaV" type="date" value="" class="form-control"></td>
            </tr>
            <tr>
                <td><label>¿Cuál es el nombre del foro donde se llevará a cabo tu evento?</label></td>
                <td><input id="nombreForo" type="text" class="form-control"></td>
            </tr>
            <tr>
                <td><label>¿Cuál es la capacidad del foro?</label></td>
                <td><input id="capacidad" type="number" class="form-control"></td>
            </tr>
            <tr>
                <td><label>¿Cuantos boletos planeas vender?</label></td>
                <td><input id="ventaAprox" type="number" class="form-control"></td>
            </tr>
            <tr>
                <td><label>¿Cuál es el costo aproximado del boleto?</label></td>
                <td><input id="costoBoleto" type="number" class="form-control"></td>
            </tr>
            <tr>
                <td><label>¿Operas alguna taquilla?</label></td>
                <td>
                    <label><input type="radio" name="taquilla" value="1">Si</label>
                    <br>
                    <label><input type="radio" name="taquilla" value="0" checked>No</label>
                </td>
            </tr>
            <tr>
                <td><label>Tu evento será de:</label></td>
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
                <td><input id="nombreCompleto" type="text" class="form-control"></td>
            </tr>
            <tr>
                <td><strong>* Email:</strong></td>
                <td><input id="email" type="email" class="form-control"></td>
            </tr>
            <tr>
                <td><label>Dirección:</label></td>
                <td><input id="direccion" class="form-control"></td>
            </tr>
            <tr>
                <td><strong>* Estado:</strong></td>
                <td>
                    <select id="estado" name="estado" class="custom-select">
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
                <td><input id="cp" type="number" class="form-control"></td>
            </tr>
            <tr>
                <td><label>Teléfono Casa</label></td>
                <td><input id="telefonoCasa" type="number" class="form-control"></td>
            </tr>
            <tr>
                <td><label>Otro Teléfono</label></td>
                <td><input id="otroTel" type="number" class="form-control"></td>
            </tr>
            <tr>
                <td><label>Comentarios:</label></td>
                <td><textarea id="comentarios" class="form-control"></textarea></td>
            </tr>
            </tbody>
        </table>
        <div align="center">
            <strong>La información es confidencial y será utilizada únicamente para los fines antes indicados.</strong>
            <div>
                <button id="enviar" type="button" class="btn btn-outline-primary" onclick="enviarVenderEv()">Enviar
                </button>
                <input id="reset" type="reset" class="btn btn-outline-secondary">
            </div>
        </div>
        <div id="error" class="alert alert-danger oculto" role="alert" align="center">
            <h4 class="alert-heading">Error!</h4>
            <p>Las casillas marcadas en rojo son obligatorias.</p>
        </div>
        <div id="alert" class="alert alert-success oculto" role="alert" align="center">
            <h4 class="alert-heading">Exito!</h4>
            <p>Se ha mandado tu solicitud con exito, mantente al pendiente de tu correo</p>
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
    function enviarVenderEv() {
        var nombreE, fechVenta, nombreF, capacidadF, boletosV, costoB, taquilla, admisionG = 0, lugarE = 0;
        var nombreC, email, direccionV, estadoV, cp, telC, telSec, comentarios;
        nombreE = document.getElementById("nombreEv").value;
        if (nombreE == "") {
            document.getElementById("nombreEv").style.borderColor = "red";
        } else {
            document.getElementById("nombreEv").style.borderColor = "";
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
        estadoV = document.getElementById("estado").value;
        if (estadoV == 0) {
            document.getElementById("estado").style.borderColor = "red";
        } else {
            document.getElementById("estado").style.borderColor = "";
        }
        if (nombreE == "" || nombreC == "" || email == "" || estadoV == 0) {
            document.getElementById("error").style.display = "block";
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            return;
        }
        fechVenta = document.getElementById("fechaV").value;
        nombreF = document.getElementById("nombreForo").value;
        capacidadF = document.getElementById("capacidad").value;
        if (capacidadF !== "") {
            if (capacidadF <= 0) {
                document.getElementById("capacidad").style.borderColor = "red";
                return;
            } else {
                document.getElementById("capacidad").style.borderColor = "";
            }
        }
        boletosV = document.getElementById("ventaAprox").value;
        if (boletosV !== "") {
            if (boletosV <= 0) {
                document.getElementById("ventaAprox").style.borderColor = "red";
                return;
            } else {
                document.getElementById("ventaAprox").style.borderColor = "";
            }
        }
        costoB = document.getElementById("costoBoleto").value;
        if (costoB !== "") {
            if (costoB <= 0) {
                document.getElementById("costoBoleto").style.borderColor = "red";
                return;
            } else {
                document.getElementById("costoBoleto").style.borderColor = "";
            }
        }
        var taquillaR = document.getElementsByName("taquilla");
        for (var i = 0; i < taquillaR.length; i++) {
            if (taquillaR[i].checked)
                taquilla = taquillaR[i].value;
        }
        if ($('#admisionG').prop('checked')) {
            admisionG = "Admision general";
        }
        if ($('#lugarEspecifico').prop('checked')) {
            lugarE = "Lugar Especifico";
        }
        direccionV = document.getElementById("direccion").value;
        cp = document.getElementById("cp").value;
        if (cp !== "") {
            if (cp.length > 5 || cp <= 0) {
                document.getElementById("cp").style.borderColor = "red";
                return;
            } else {
                document.getElementById("cp").style.borderColor = "";
            }
        }
        telC = document.getElementById("telefonoCasa").value;
        telSec = document.getElementById("otroTel").value;
        comentarios = document.getElementById("comentarios").value;
        var params = {
            "nombreE": nombreE,
            "fechaventa": fechVenta,
            "nombreF": nombreF,
            "capacidadF": capacidadF,
            "boletosV": boletosV,
            "costoB": costoB,
            "taquilla": taquilla,
            "admisionG": admisionG,
            "lugarE": lugarE,
            "nombreC": nombreC,
            "email": email,
            "direccion": direccionV,
            "estado": estadoV,
            "cp": cp,
            "telC": telC,
            "telSec": telSec,
            "comentarios": comentarios
        };
        $.ajax({
            data: params,
            url: "/Phps/venderBoletos.php",
            type: "post",
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
