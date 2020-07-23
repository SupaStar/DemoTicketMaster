<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
require_once($_SERVER["DOCUMENT_ROOT"] . '/Phps/dbConfig.php');
$numero = $_POST["numero"];
$nombre = $_POST["nombre"];
$fechaEx = $_POST["fechaEx"];
$codigo = $_POST["codigo"];
$idU = $_SESSION["usuario"];
$sql = "Insert into tarjetas VALUES (null,'$numero','$nombre','$fechaEx','$codigo','$idU')";
$res = $mysqli->query($sql);
echo json_encode(["estado" => $res]);
