<div class="modal fade" id="myModal" role="dialog">
    <div id="errorM" class="alert alert-danger oculto" role="alert" align="center">
        <h4 class="alert-heading">Error!</h4>
        <p>No se ah seleccionado ninguna imagen.</p>
    </div>
    <div id="errorMC" class="alert alert-danger oculto" role="alert" align="center">
        <h4 class="alert-heading">Error!</h4>
        <p>Proporciona una contraseña para el vendedor.</p>
        <p>Y comprueba que las contraseñas coincidan</p>
    </div>
    <div id="errorMS" class="alert alert-danger oculto" role="alert" align="center">
        <h4 class="alert-heading">Error!</h4>
        <p>Selecciona un numero de secciones y llena los campos.</p>
    </div>
    <input id="idF" hidden>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="left">Aceptar foro.</h4>
                <button onclick="limpiar()" type="button" id="close" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <table>
                        <tr>
                            <td><span class="input-group-text">Contraseña cuenta vendedor:</span></td>
                            <td><input type="password" id="passV" class="form-control" value=""></td>
                        </tr>
                        <tr>
                            <td><span class="input-group-text">Confirma la contraseña:</span></td>
                            <td><input type="password" id="passVr" class="form-control" value=""></td>
                        </tr>
                    </table>
                </div>
                <div class="mb-4">
                    <select id="nSecc" onchange="mostrarSecciones()" class="custom-select">
                        <option value="0">Seleccione el numero de secciones que tiene el foro</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                    </select>
                </div>
                <table id="secciones" class="table table-hover mb-4"></table>
                <div class="input-group mb-3 inputsModal">
                    <div class="custom-file" oninput="labi.value=imagen.value">
                        <input type="file" class="custom-file-input" id="imagen" aria-describedby="imagen"
                               accept="image/*">
                        <label class="custom-file-label" for="imagen" id="labi">Escoger imagen del foro</label>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04"
                                onclick="cargarIMG()">Subir
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="limpiar()" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var nSecc = 0;
    function limpiar() {
        $("#nSecc").val(0);
        $("#secciones").empty();
        $("#passV").val("");
    }
    function mostrarSecciones() {
        nSecc = $("#nSecc").val();
        if (nSecc > 0) {
            $("#secciones").empty();
            for (var i = 1; i <= nSecc; i++) {
                $("#secciones").append('<tr align="center"><td colspan="3"><span>Seccion #' + i + '</span></td>' +
                    '</tr><tr><td><span>Nombre de la seccion:</span></td><td><input id="nSeccion' + i + '" type="text"></td>' +
                    '</tr><tr><td><span>Capacidad de la seccion:</span></td>' +
                    '<td><input id="capacidadSeccion' + i + '" type="number" min="0"></td></tr>');
            }
        } else {
            $("#secciones").empty();
        }
    }

    function cargarIMG() {
        if (nSecc === 0) {
            document.getElementById("errorMS").style.display = "block";
            setTimeout(function () {
                document.getElementById("errorMS").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
            return;
        }
        var pass = $("#passV").val();
        if (pass === "") {
            document.getElementById("errorMC").style.display = "block";
            setTimeout(function () {
                document.getElementById("errorMC").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
            return;
        } else if ($("#passVr").val() !== pass) {
            document.getElementById("errorMC").style.display = "block";
            setTimeout(function () {
                document.getElementById("errorMC").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
            return;
        }
        var secciones = [];
        for (var i = 1; i <= nSecc; i++) {
            if ($("#nSeccion" + i).val() === "") {
                document.getElementById("errorMS").style.display = "block";
                setTimeout(function () {
                    document.getElementById("errorMS").style.display = "none";
                }, 7000);
                window.scrollTo(0, 0);
                return;
            }
            if ($("#capacidadSeccion" + i).val() === "" || $("#capacidadSeccion" + i).val() <= 0) {
                document.getElementById("errorMS").style.display = "block";
                setTimeout(function () {
                    document.getElementById("errorMS").style.display = "none";
                }, 7000);
                window.scrollTo(0, 0);
                return;
            }
            var seccion = {
                "nombre": $("#nSeccion" + i).val(),
                "capacidad": $("#capacidadSeccion" + i).val()
            };
            secciones.push(seccion);
        }
        var seccio = JSON.stringify(secciones);
        var a = document.getElementById("imagen");
        if (a.files[0] === undefined || a === null) {
            document.getElementById("errorM").style.display = "block";
            setTimeout(function () {
                document.getElementById("errorM").style.display = "none";
            }, 7000);
            window.scrollTo(0, 0);
            return;
        }
        var id = $('#idF').val();
        var img = new FormData();
        img.append("funcion", 3);
        img.append("id", id);
        img.append("img", a.files[0]);
        img.append("secciones", seccio);
        $.ajax({
            data: img,
            url: "/Phps/MetodosAdmin.php",
            type: "post",
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var json = $.parseJSON(response);
                if (json.estado) {
                    document.getElementById("alert").style.display = "block";
                    document.getElementById("alert").style.opacity = "0.9";
                    setTimeout(function () {
                        document.getElementById("alert").style.display = "none";
                    }, 7000);
                    $('#imagen').val(null);
                    $('#idT').val(id);
                    $("#dir").val(json.ruta);
                    ejecutarAceptacion(json.secciones);
                    $('#close').click();
                    window.scrollTo(0, 0);
                } else {

                }
            }
        });

    }

</script>