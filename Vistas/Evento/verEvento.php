<html>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/head.php');
?>
<body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/header.php');
require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/dbConfig.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/Eventos/fechas.php");
require_once($_SERVER["DOCUMENT_ROOT"] . '/Vistas/Modales/modalDatosTarjeta.php');
$id = $_GET["id"];
$sql = "SELECT
    eventosaceptados.nombreEv,
    eventosaceptados.taquilla,
    eventosaceptados.fechaVenta,
    forosaceptados.nombreF,
    forosaceptados.idF,
    forosaceptados.direccionF,
    forosaceptados.ciudadF,
    forosaceptados.estadoF,
    forosaceptados.adminGen,
    forosaceptados.lugarEs,
    forosaceptados.rutaImg
FROM
    eventosaceptados
INNER JOIN forosaceptados ON eventosaceptados.idForo = forosaceptados.idF
WHERE
    eventosaceptados.idEv ='$id'";
$res = $mysqli->query($sql);
?>
<nav aria-label="breadcrumb" class="padBod">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Evento</li>
    </ol>
</nav>
<div class="contenido">
    <div id="error" align="center" class="alert alert-danger oculto" role="alert">
        <h4 class="alert-heading">Error!</h4>
        <p id="msjE"></p>
    </div>
    <div id="alert" class="alert alert-success oculto" role="alert" align="center">
        <h4 class="alert-heading">Exito!</h4>
        <p id="msj"></p>
    </div>
    <?php
    foreach ($res as $row) { ?>
        <table class="tablitainfo">
            <tr class="titulito">
                <td><h1 class="tituloPerfiles">Evento</h1></td>
                <td class="separador">
                    <?php
                    $dia = date('d', strtotime($row["fechaVenta"]));
                    $diaS = date('l', strtotime($row["fechaVenta"]));
                    $mes = date('F', strtotime($row["fechaVenta"]));
                    $annio = date('o', strtotime($row["fechaVenta"]));
                    ?>
                    <h4><?php echo $row["nombreEv"]; ?></h4>
                    <h6><?php echo $row["nombreF"]; ?>, <?php echo $row["direccionF"]; ?></h6>
                    <span><?php echo diaEsp($diaS) . ' ' . $dia . ' ' . mesEsp($mes) . ' ' . $annio; ?></span>
                </td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <td><span>Cant.</span>
                    <select id="cantidad" class="custom-select" onchange="obtenerCosto()">
                        <option value=0>0</option>
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                        <option value=6>6</option>
                        <option value=7>7</option>
                        <option value=8>8</option>
                    </select>
                </td>
                <td>
                    <span>Tipo de boleto</span>
                    <select id="tipoB" class="custom-select">
                        <option value=0>Boleto normal</option>
                    </select>
                </td>
                <td colspan="3">
                    <span>Seccion</span>
                    <br>
                    <button id="botonsito" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">Seccion
                    </button>
                    <div class="dropdown-menu">
                        <?php
                        $idForito = $row["idF"];
                        $sqlSecc = "SELECT `idSeccion`,`nombre`,`capacidad` FROM `secciones` WHERE `idForo`='$idForito' ORDER BY `idSeccion`";
                        $result = $mysqli->query($sqlSecc);
                        $precios = [];
                        $sqlPrec = "Select idBoletos,costoB from boletos WHERE idEv='$id' ORDER BY idSeccion";
                        $resPre = $mysqli->query($sqlPrec);
                        foreach ($resPre as $precrow) {
                            $precio = $precrow["costoB"];
                            $seccionid = $precrow["idBoletos"];
                            $secPrec = ["id" => $seccionid, "precio" => $precio];
                            array_push($precios, $secPrec);
                        }
                        $i = 0;
                        foreach ($result as $rowsita) {
                            ?>
                            <label class="dropdown-item">
                                <input onclick="cambiarPrecio(<?php echo $precios[$i]["id"]; ?>,<?php echo $precios[$i]["precio"]; ?>)"
                                       type="radio"
                                       name="seccionsilla"
                                       value="<?php echo $rowsita["nombre"]; ?>"><?php echo $rowsita["nombre"] ?>
                            </label>
                            <div class="dropdown-divider"></div>
                            <?php
                            $i++;
                        }
                        ?>
                    </div>
                </td>
            </tr>
        </table>
        <div>
            <h2>Costo total= </h2>
            <h1 id="costoT"></h1>
        </div>
        <?php if (isset($_SESSION["usuario"])) { ?>
            <div id="paypal" align="center"></div>
            <!-- <div align="right" style="padding:30px 0;">
                <button id="btnComprar" class="btn btn-success btn-block"
                        data-backdrop="static"
                        data-toggle="modal" data-target="#myModal" onclick="validar()">Comprar
                </button>
            </div> -->
        <?php } else {
            ?>
            <div align="right" style="padding:30px 0;">
                <a href="/Vistas/vistaRegistro.php" class="btn btn-success btn-block">Comprar</a>
            </div>
            <?php
        } ?>
        <div align="center" class="mapa">
            <img src="<?php echo $row["rutaImg"] ?>" alt="MAPA NO DISPONIBLE">
        </div>
        <?php
    }
    ?>
</div>
<script src="https://www.paypal.com/sdk/js?client-id=Aca13bTpgQ0arp9Tdl-Nmw35qi3YrA4DXDBRfec2TVpzlTwUxTBlLW9DAX1UuHU67aGq7r8umZCXYZrE&currency=MXN"></script>

<script>
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay',
            height: 40,
            layout: 'horizontal'
        },
        // Set up the transaction
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '500.00'
                    },
                    code: {
                        value: 'MXN'
                    }
                }]
            });
        },

        // Finalize the transaction
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {
                // Show a success message to the buyer
                comprita(details);
            });
        }


    }).render('#paypal');
</script>
</body>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/footer.php');
?>
</html>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/Plantillas/scripts.php');
?>
<script>
    var idSec = 0;
    var preciog = 0;
    var msjE = $("#msjE");
    var cantidad = "0";
    var costoTLbl = $("#costoT");
    var costoT = 0;
    function cambiarPrecio(id, precio) {
        idSec = id;
        var seccion;
        var seccionR = document.getElementsByName("seccionsilla");
        for (var i = 0; i < seccionR.length; i++) {
            if (seccionR[i].checked)
                seccion = seccionR[i].value;
        }
        preciog = precio;
        $("#botonsito").html(seccion + " " + precio + "MXN");
        obtenerCosto();
    }
    function comprita(details) {
        if (details.id !== "") {
            console.log(details);
            console.log(details.id);
            validar(details.id);
        }
    }
    function obtenerCosto() {
        cantidad = $("#cantidad").val();
        costoT = preciog * cantidad;
        costoTLbl.empty();
        costoTLbl.append(costoT);
    }
    function validar(idT) {
        if (cantidad === "0") {
            msjE.empty();
            msjE.append("Selecciona una cantidad.");
            document.getElementById("error").style.display = "block";
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            setTimeout(function () {
                $('#close').click();
            }, 470);
            window.scrollTo(0, 0);
            return;
        }
        if (idSec === 0) {
            msjE.empty();
            msjE.append("Selecciona una seccion.");
            document.getElementById("error").style.display = "block";
            setTimeout(function () {
                document.getElementById("error").style.display = "none";
            }, 7000);
            setTimeout(function () {
                $('#close').click();
            }, 470);
            window.scrollTo(0, 0);
        }
        comprar(idT);
    }
    function comprar(idT) {
        var params = {
            "cantidad": cantidad,
            "idBol": idSec,
            "idT": idT
        };
        $.ajax({
            data: params,
            type: "post",
            url: "/Phps/Eventos/comprar.php",
            beforeSend: function () {
                $('#btnComprar').attr('disabled', 'disabled').prepend('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div>');
            },
            success: function (response) {
                var msj = $("#msj");
                var json = $.parseJSON(response);
                if (json.estado) {
                    $('#btnComprar').removeAttr('disabled').find('div.spinner-border').remove();
                    msj.empty();
                    msj.append("Compra hecha con exito.");
                    document.getElementById("alert").style.display = "block";
                    setTimeout(function () {
                        document.getElementById("alert").style.display = "none";
                    }, 7000);
                    window.scrollTo(0, 0);
                } else {
                    $('#btnComprar').removeAttr('disabled').find('div.spinner-border').remove();
                    msjE.empty();
                    msjE.append(json.detalle);
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