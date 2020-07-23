<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}
require_once($_SERVER["DOCUMENT_ROOT"] . '/Phps/dbConfig.php');
switch ($_POST["funcion"]) {
    case 1:
        datosP($mysqli);
        break;
    case 2:
        correo($mysqli);
        break;
    case 3:
        password($mysqli);
        break;
}
function datosP($mysqli)
{
    $nombre = $_POST["nombre"];
    $apPat = $_POST["apPat"];
    $apMat = $_POST["apMat"];
    $id = $_SESSION["usuario"];
    $sql = "Update usuarios set nombre='$nombre',apPaterno='$apPat',apMaterno='$apMat' WHERE id='$id'";
    $result = $mysqli->query($sql);
    echo json_encode(["estado" => $result]);
}

function correo($mysqli)
{
    $id = $_SESSION["usuario"];
    $correo = $_POST["correo"];
    $sql = "Update usuarios set correo='$correo' WHERE id='$id'";
    $result = $mysqli->query($sql);
    echo json_encode(["estado" => $result]);
}

function password($mysqli)
{
    $paswordA = $_POST["passA"];
    $paswordN = $_POST["passN"];
    $id = $_SESSION["usuario"];
    $contrabd = "";
    $sql = "select password from usuarios WHERE  id='$id'";
    $result = $mysqli->query($sql);
    foreach ($result as $row) {
        $contrabd = $row["password"];
    }
    if (password_verify($paswordA, $contrabd)) {
        $passNHash = password_hash($paswordN, PASSWORD_DEFAULT);
        $sqlN = "Update usuarios set password='$passNHash' WHERE id='$id'";
        $response = $mysqli->query($sqlN);
        echo json_encode(["estado" => $response]);
    } else {
        echo json_encode(["estado" => false]);
    }
}
