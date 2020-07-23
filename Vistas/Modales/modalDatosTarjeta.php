<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="errorM" class="alert alert-danger oculto" role="alert" align="center">
                <h4 class="alert-heading">Error!</h4>
                <p id="msjEM"></p>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" align="left">Aceptar foro.</h4>
                <button onclick="limpiar()" type="button" id="close" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <table>
                        <tr>
                            <td><span class="input-group-text">Numero de tarjeta</span></td>
                            <td colspan="3"><input id="nTarjeta" type="number" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><span class="input-group-text">Nombre y apellido</span></td>
                            <td><input id="nombreTarj" class="form-control" value=""></td>
                        </tr>
                        <tr>
                            <td><span class="input-group-text">Fecha de expiracion</span>
                                <input id="fechaEx" type="date" class="form-control" value="">
                            </td>
                            <td><span class="input-group-text">Codigo de seguridad</span>
                                <input id="codigoS" type="number" class="form-control">
                            </td>
                        </tr>
                    </table>
                    <div align="right">
                        <button type="button" class="btn btn-primary" onclick="guardarT()">Comprar</button>
                    </div>
                    <input id="reset" type="reset" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <button onclick="limpiar()" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function limpiar() {
        $('#reset').click();
    }
    function guardarT() {
        var nTarj, nombre, fechaEx, codigo, msjEM;
        msjEM = $("#msjEM");
        nTarj = $("#nTarjeta").val();
        nombre = $("#nombreTarj").val();
        fechaEx = $("#fechaEx").val();
        codigo = $("#codigoS").val();
        if (nTarj === "" || nTarj <= 0) {
            msjEM.empty();
            msjEM.append("Asegurate que todos los datos esten correctos y llenos.");
            document.getElementById("errorM").style.display = "block";
            setTimeout(function () {
                document.getElementById("errorM").style.display = "none";
            }, 7000);
            return;
        }
        if (nombre === "") {
            msjEM.empty();
            msjEM.append("Asegurate que todos los datos esten correctos y llenos.");
            document.getElementById("errorM").style.display = "block";
            setTimeout(function () {
                document.getElementById("errorM").style.display = "none";
            }, 7000);
            return;
        }
        if (fechaEx === "") {
            msjEM.empty();
            msjEM.append("Asegurate que todos los datos esten correctos y llenos.");
            document.getElementById("errorM").style.display = "block";
            setTimeout(function () {
                document.getElementById("errorM").style.display = "none";
            }, 7000);
            return;
        }
        if (codigo.length > 3 || codigo <= 0 || codigo === "") {
            msjEM.empty();
            msjEM.append("Asegurate que el codigo de seguridad sea correcto.");
            document.getElementById("errorM").style.display = "block";
            setTimeout(function () {
                document.getElementById("errorM").style.display = "none";
            }, 7000);
            return;
        }
        var tarjeta = {
            "numero": nTarj,
            "nombre": nombre,
            "fechaEx": fechaEx,
            "codigo": codigo
        };
        $.ajax({
            data: tarjeta,
            type: "post",
            url: "/Phps/Eventos/agregarTarjeta.php",
            success: function (response) {
                var json = $.parseJSON(response);
                if (json.estado) {
                    $('#close').click();
                    comprar();
                } else {
                    msjEM.empty();
                    msjEM.append("Ocurrio un error.");
                    document.getElementById("errorM").style.display = "block";
                    setTimeout(function () {
                        document.getElementById("errorM").style.display = "none";
                    }, 7000);
                }
            }
        });
    }
</script>