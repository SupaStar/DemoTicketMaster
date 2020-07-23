<div class="modal fade" id="myModal" role="dialog">
    <div id="errorM" class="alert alert-danger oculto" role="alert" align="center">
        <h4 class="alert-heading">Error!</h4>
        <p>No se ah seleccionado ningun foro.</p>
    </div>
    <div id="errorMC" class="alert alert-danger oculto" role="alert" align="center">
        <h4 class="alert-heading">Error!</h4>
        <p>Llena todos los campos.</p>
        <p>Asegurate de que las contraseñas sean las mismas.</p>
    </div>
    <div id="errorME" class="alert alert-danger oculto" role="alert" align="center">
        <h4 class="alert-heading">Error!</h4>
        <p>Ocurrio un error intentalo mas tarde.</p>
    </div>
    <input id="fechaActual" type="date" hidden>
    <input id="idE" hidden>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="left">Aceptar evento.</h4>
                <button onclick="limpiarRegistro()" type="button" id="close" class="close" data-dismiss="modal">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr id="fechaV"></tr>
                    <tr>
                        <td>
                            <span class="input-group-text col-lg-auto">Introduce una contraseña para el vendedor</span>
                        </td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="password" id="password"></td>
                    </tr>
                    <tr>
                        <td><span class="input-group-text">Repite la contraseña para el vendedor</span></td>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="password" id="rpassword"></td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" id="cats" onchange="subCats()">
                                <option value="0">Selecciona una categoria del evento</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td hidden id="sCat">
                            <select class="form-control" id="subcat">
                            </select>
                        <td>
                    </tr>
                    <tr>
                        <td><span class="input-group-text">Selecciona el foro donde se presentara el evento:</span></td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" id="foros" onchange="nSecc()">
                                <option value="0">Selecciona un foro</option>
                            </select>
                        </td>
                    </tr>
                    <table class="table table-hover mb-4" hidden id="nS">
                    </table>
                </table>
                <div align="right">
                    <button class="btn btn-outline-primary btn-block" onclick="aceptar()">Registrar evento</button>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="limpiarRegistro()" id="close" type="button" class="btn btn-default"
                        data-dismiss="modal">Close
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    var nSecci = 0;
    var fech = new Date();
    var mes = "0";
    if (fech.getMonth() + 1 < 10) {
        mes += fech.getMonth() + 1
    } else {
        mes = fech.getMonth() + 1;
    }
    var fecha = fech.getFullYear() + '-' + mes + '-' + fech.getDate();
    $("#fechaActual").val(fecha);
    var foritos = [];
    $(document).ready(function () {
        var id = $("#idE").val();
        var params = {
            "id": id,
            "funcion": 6
        };
        $.ajax({
            data: params,
            url: "/Phps/MetodosAdmin.php",
            type: "post",
            success: function (response) {
                if (response !== "") {
                    var json = $.parseJSON(response);
                    var datos = $.parseJSON(json.data);
                    $.each(datos, function (key, registro) {
                        $("#foros").append('<option value="' + registro.id + '">' + registro.nombre + '</option>');
                    });
                }
            }
        });
        var params1 = {
            "funcion": 7
        };
        $.ajax({
            data: params1,
            type: "post",
            url: "/Phps/MetodosAdmin.php",
            success: function (response) {
                if (response != "") {
                    var json = $.parseJSON(response);
                    var datos = $.parseJSON(json.data);
                    $.each(datos, function (key, registro) {
                        $("#cats").append('<option value="' + registro.id + '">' + registro.descripcion + '</option>');
                    });
                }
            }
        });
    });
    function nSecc() {
        var selEs = $("#foros").val();
        var paraSecc = {
            "idF": selEs,
            "funcion": 9
        };
        $.ajax({
            data: paraSecc,
            type: "post",
            url: "/Phps/MetodosAdmin.php",
            success: function (response) {
                var json = $.parseJSON(response);
                nSecci = $.parseJSON(json.data);
                $("#nS").empty();
                for (var i = 1; i <= nSecci; i++) {
                    $("#nS").append('<tr>' +
                        '<td><span>Costo de boletos seccion#' + i + '</span></td>' +
                        '<td><input id="nuSecc' + i + '" type="number" min=0 class="form-control" value=0></td></tr>');
                }
                $('#nS').removeAttr('hidden');
            }
        });
    }
    function subCats() {
        var catSel = $("#cats").val();
        if (catSel == "0") {
            $('#sCat').attr('hidden', true);
            $("#subcat").empty();
        } else {
            params2 = {
                "idCat": catSel,
                "funcion": 8
            };
            $.ajax({
                data: params2,
                type: "post",
                url: "/Phps/MetodosAdmin.php",
                success: function (response) {
                    if (response != "") {
                        var json = $.parseJSON(response);
                        var datos = $.parseJSON(json.data);
                        $("#subcat").append('<option value="0">Selecciona una categoria del evento</option>');
                        $.each(datos, function (key, registro) {
                            $("#subcat").append('<option value="' + registro.id + '">' + registro.descripcion + '</option>');
                        });
                        $('#sCat').removeAttr('hidden');
                    }
                }
            });
        }
    }
    function limpiarRegistro() {
        $("#password").val("");
        $("#fechaV").empty();
        $("#foros").val("0");
    }
    function aceptar() {
        var fechita = $("#fechita").val();
        var sel = $("#foros").val();
        var cat = $("#cats").val();
        if (sel === "0") {
            document.getElementById("errorM").style.display = "block";
            setTimeout(function () {
                document.getElementById("errorM").style.display = "none";
            }, 7000);
            return;
        }
        if (cat === "0") {
            document.getElementById("cats").style.borderColor = "red";
            return;
        } else {
            document.getElementById("cats").style.borderColor = "";
        }
        var subCat = $("#subcat").val();
        if (subCat === "0") {
            document.getElementById("subcat").style.borderColor = "red";
            return;
        }
        var pass = $("#password").val();
        var rpasswordF = $("#rpassword").val();
        if (pass.length < 8) {
            document.getElementById("errorMC").style.display = "block";
            setTimeout(function () {
                document.getElementById("errorMC").style.display = "none";
            }, 7000);
            return;
        }
        if (pass !== rpasswordF) {
            document.getElementById("errorMC").style.display = "block";
            setTimeout(function () {
                document.getElementById("errorMC").style.display = "none";
            }, 7000);
            return;
        }
        var secciones = [];
        for (var i = 1; i <= nSecci; i++) {
            var sec = "nuSecc" + i;
            var input = $("#" + sec).val();
            var inputenNumero=parseFloat(input,10);
            if (inputenNumero === 0 || inputenNumero < 0) {
                document.getElementById(sec).style.borderColor = "red";
                return;
            } else {
                document.getElementById(sec).style.borderColor = "";
                var seccion = {
                    "costoB": inputenNumero
                };
                secciones.push(seccion);
            }
        }
        var seccionesJson = JSON.stringify(secciones);
        var idF = $("#foros").val();
        var params = {
                "id": $("#idE").val(),
                "idF": idF,
                "password": pass,
                "funcion": 4,
                "fechaV": fechita,
                "cat": cat,
                "subcat": subCat,
                "costosSecc": seccionesJson
            }
        ;
        $.ajax({
            data: params,
            url: "/Phps/MetodosAdmin.php",
            type: "post",
            success: function (response) {
                var json = $.parseJSON(response);
                if (json.estado) {
                    $("#rpassword").val("");
                    $("#password").val("");
                    $("#foros").val(0);
                    $('#close').click();
                    borrarT();
                } else {
                    document.getElementById("errorME").style.display = "block";
                    setTimeout(function () {
                        document.getElementById("errorME").style.display = "none";
                    }, 7000);
                    window.scrollTo(0, 0);
                }
            }
        });
    }
</script>
