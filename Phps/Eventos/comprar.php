<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
require_once($_SERVER["DOCUMENT_ROOT"] . '/Phps/dbConfig.php');
$idU = $_SESSION["usuario"];
$cantidad = $_POST["cantidad"];
$idBoletos = $_POST["idBol"];
$idT=$_POST["idT"];
$sqlSelect = "select restantes from boletos WHERE idBoletos='$idBoletos'";
$resultado = $mysqli->query($sqlSelect);
$restantes = 0;
foreach ($resultado as $row) {
    $restantes = $row["restantes"];
}
if ($restantes < $cantidad) {
    echo json_encode(["estado" => false, "detalle" => "La cantidad supera al stock,intenta con una menor cantidad"]);
} else {
    $hoy = getdate();
    $d = $hoy['mday'];
    $m = $hoy['mon'];
    $y = $hoy['year'];
    $fecha = $y . "-" . $m . "-" . $d;
    $nuevosR = $restantes - $cantidad;
    $sqlAgregar = "insert into boletoscomp VALUES (null,'$idU','$idBoletos','$cantidad','$idT','$fecha')";
    $res = $mysqli->query($sqlAgregar);
    if ($res) {
        $sqlNR = "update boletos set restantes='$nuevosR' WHERE idBoletos='$idBoletos'";
        $result = $mysqli->query($sqlNR);
        echo json_encode(["estado" => $result]);
    } else {
        echo json_encode(["estado" => false, "detalle" => "Algo ah fallado"]);
    }
}
?>