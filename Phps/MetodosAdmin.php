<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/Phps/dbConfig.php");
$funcion = $_POST["funcion"];
switch ($funcion) {
    case 1://Funcion aceptar Foros de revision
        $id = $_POST["id"];
        aceptarForosRev($id, $mysqli);
        break;
    case 2://Funcion eliminar Foros de revision
        $id = $_POST["id"];
        aceptarForosRev($id, $mysqli);
        break;
    case 3://Subir imagenes de foros antes de aceptarlos
        $id = $_POST["id"];
        subirImgRev($id);
        break;
    case 4://Aceptar eventos
        $id = $_POST["id"];
        aceptarEventosRev($id, $mysqli);
        break;
    case 5://Eliminar eventos de revision
        $id = $_POST["id"];
        eliminarEventosRev($id, $mysqli);
        break;
    case 6://Ver foros
        verForos($mysqli);
        break;
    case 7://Obtener categorias
        verCategorias($mysqli);
        break;
    case 8://Sub categorias de una categoria
        verSubCat($mysqli);
        break;
    case 9:
        obtenerNSecciones($mysqli);
        break;
}
function aceptarForosRev($id, $mysqli)
{
    $secciones = json_decode($_POST["secciones"], true);
    $ruta = $_POST["directorio"];
    $sql = "Select * from forospendientes WHERE idInmP=" . $id;
    $result = $mysqli->query($sql);
    foreach ($result as $row) {
        $nombreF = $row["nombreForo"];
        $direccionForo = $row["direccionForo"];
        $ciudadForo = $row["ciudadForo"];
        $estadoForo = $row["estadoForo"];
        $capacidadForo = $row["capacidadForo"];
        $eventosForo = $row["eventosForo"];
        $boletosForo = $row["boletosForo"];
        $adminGeneral = $row["adminGeneral"];
        $lugarE = $row["lugarE"];
        $nombreCompleto = $row["nombreCompleto"];
        $email = $row["email"];
        $direccionVend = $row["direccionVend"];
        $estadoVend = $row["estadoVend"];
        $cp = $row["cp"];
        $telefonoOf = $row["telefonoOf"];
        $telefonoSec = $row["telefonoSec"];
        $comentarios = $row["comentarios"];
    }
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $sql = "insert into usuarios VALUES (null,'$nombreCompleto',null,
null,'$email','$password',2)";
    $estadoU = $mysqli->query($sql);
    if ($estadoU) {
        $sqll = "Select id from usuarios where correo='$email'";
        $usuario = $mysqli->query($sqll);
        foreach ($usuario as $row) {
            $idU = $row["id"];
        }
        $idV = crearVendedor($mysqli, $idU, $direccionVend, $estadoVend, $cp, $telefonoOf, $telefonoSec);
        $sql = "INSERT INTO forosaceptados values
        (null,'$nombreF','$direccionForo','$ciudadForo','$estadoForo','$capacidadForo',
        '$adminGeneral','$lugarE','$ruta','$idV')";
        $result = $mysqli->query($sql);
        if ($result) {
            $sqlSec = "select idF from forosaceptados WHERE nombreF='$nombreF' AND direccionF='$direccionForo'";
            $foro = $mysqli->query($sqlSec);
            foreach ($foro as $row) {
                $idF = $row["idF"];
            }
            foreach ($secciones as $seccion) {
                $nombre = $seccion["nombre"];
                $capacidad = $seccion["capacidad"];
                $sqlSecc = "insert into secciones VALUES (null,'$nombre','$capacidad',$idF)";
                $mysqli->query($sqlSecc);
            }
            $sql = "UPDATE forospendientes set estado=0 WHERE idInmP= " . $id;
            $res = $mysqli->query($sql);
            echo json_encode(["estado" => $res]);
        } else {
            echo json_encode(["estado" => false]);
        }

    } else {
        echo json_encode(["estado" => false]);
    }
}

function eliminarForosRev($id, $mysqli)
{
    $sql = "UPDATE forospendientes set estado=0 WHERE idInmP= " . $id;
    $res = $mysqli->query($sql);
    echo json_encode(["estado" => $res]);
}

function subirImgRev($id)
{
    $secciones = $_POST["secciones"];
    $dir = $_SERVER["DOCUMENT_ROOT"] . "/Imagenes/Foros";
    $fileNameUsr = $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];
    $filename = $id . $fileNameUsr;
    $direccionFinal = "/Imagenes/Foros/" . $filename;
    if (is_dir($dir) && is_uploaded_file($tmp_name)) {
        if (move_uploaded_file($tmp_name, $dir . '/' . $filename)) {
            echo json_encode(["estado" => true, "ruta" => $direccionFinal, "secciones" => $secciones]);
        } else {
            echo json_encode(["estado" => false]);
        }
    }
}

function aceptarEventosRev($id, $mysqli)
{
    $idF = $_POST["idF"];
    $sql = "Select * from eventospendientes WHERE idEvPentientes=" . $id;
    $result = $mysqli->query($sql);
    $fechaVenta = 0;
    foreach ($result as $row) {
        $nombreEvento = $row["nombreEvento"];
        $fechaVenta = $row["fechaVenta"];
        $nombreForo = $row["nombreForo"];
        $capacidadForo = $row["capacidadForo"];
        $boletosVender = $row["boletosVender"];
        $costoBoleto = $row["costoBoleto"];
        $taquilla = $row["taquilla"];
        $admisionGeneral = $row["admisionGeneral"];
        $lugarEspecifico = $row["lugarEspecifico"];
        $nombreCompleto = $row["nombreCompleto"];
        $email = $row["email"];
        $direccion = $row["direccion"];
        $estado = $row["estado"];
        $cp = $row["cp"];
        $telCasa = $row["telCasa"];
        $telSecundario = $row["telSecundario"];
        $comentarios = $row["comentarios"];
        $fechaVenta = $row["fechaVenta"];
    }
    $cat = $_POST["cat"];
    $subcat = $_POST["subcat"];
    $idU = crearUsuario($mysqli, $nombreCompleto, $email);
    $idV = crearVendedor($mysqli, $idU, $direccion, $estado, $cp, $telCasa, $telSecundario);
    if (strtotime($fechaVenta) < 0) {
        $fechaVenta = $_POST["fechaV"];
    }
    $sqlF = "insert into eventosaceptados VALUES (null,'$nombreEvento','$taquilla','$fechaVenta','$idV','$idF','$cat','$subcat')";
    $mysqli->query($sqlF);
    $idEa = obtenerIDEa($mysqli, $nombreEvento, $fechaVenta);
    $res = registrarBC($mysqli, $idEa, $idF);
    if ($res) {
        $sqlEP = "update eventospendientes set estadoReg=0 WHERE idEvPentientes= " . $id;
        $res = $mysqli->query($sqlEP);
        echo json_encode(["estado" => $res]);
    } else {
        echo json_encode(["estado" => $res]);
    }
}

function registrarBC($mysqli, $idEa, $idF)
{
    $costossec = json_decode($_POST["costosSecc"], true);
    $ids = [];
    $capacidades = [];
    $sql = "SELECT `idSeccion` as idS, capacidad from secciones WHERE `idForo` ='$idF' ORDER by `idSeccion`";
    $ideas = $mysqli->query($sql);
    foreach ($ideas as $row) {
        $id = $row["idS"];
        $capacidad = $row["capacidad"];
        array_push($ids, $id);
        array_push($capacidades, $capacidad);
    }
    $i = 0;
    $res = false;
    foreach ($costossec as $costoB) {
        $costo = $costoB["costoB"];
        $id = $ids[$i];
        $capacidad = $capacidades[$i];
        $sql = "Insert into boletos values(null,'$costo','$capacidad','$id','$idEa')";
        $res = $mysqli->query($sql);
        $i++;
    }
    return $res;
}

function obtenerIDEa($mysqli, $nombreEvento, $fechaVenta)
{
    $sql = "Select idEv from eventosaceptados where nombreEv='$nombreEvento' AND fechaVenta='$fechaVenta'";
    $evento = $mysqli->query($sql);
    $id = 0;
    foreach ($evento as $row) {
        $id = $row["idEv"];
    }
    return $id;
}

function crearUsuario($mysqli, $nombreCompleto, $email)
{
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $sql = "insert into usuarios VALUES (null,'$nombreCompleto',null,null,'$email','$password',2)";
    $res = $mysqli->query($sql);
    if ($res) {
        $sqlB = "select * from usuarios WHERE correo='$email'";
        $resp = $mysqli->query($sqlB);
        $idU = "";
        foreach ($resp as $row) {
            $idU = $row["id"];
        }
        return $idU;
    } else {
        echo json_encode(["estado" => false]);
    }
}

function crearVendedor($mysqli, $idU, $direccion, $estado, $cp, $telOf, $telSec)
{
    $sql = "insert into vendedores VALUES (null,'$idU','$direccion','$estado','$cp','$telOf','$telSec')";
    $res = $mysqli->query($sql);
    if ($res) {
        $sqlB = "select * from vendedores WHERE idUsuario='$idU' AND direccion='$direccion'";
        $vendedor = $mysqli->query($sqlB);
        $idV = "";
        foreach ($vendedor as $row) {
            $idV = $row["idVendedor"];
        }
        return $idV;
    } else {
        echo json_encode(["estado" => false]);
    }
}

function eliminarEventosRev($id, $mysqli)
{
    $sql = "update eventospendientes set estadoReg=0 WHERE idEvPentientes=" . $id;
    $res = $mysqli->query($sql);
    echo json_encode(["estado" => $res]);
}

function verForos($mysqli)
{
    $sql = "SELECT * from verforosaceptado";
    $res = $mysqli->query($sql);
    $foros = [];
    foreach ($res as $row) {
        $idF = $row["idF"];
        $nombreF = $row["nombreF"];
        $foro = ["id" => $idF, "nombre" => $nombreF];
        array_push($foros, $foro);
    }
    $jsonF = json_encode($foros);
    echo json_encode(["data" => $jsonF]);
}

function verCategorias($mysqli)
{
    $sql = "SELECT * from categorias";
    $res = $mysqli->query($sql);
    $categorias = [];
    foreach ($res as $row) {
        $idCat = $row["idCat"];
        $desc = $row["descripcion"];
        $categoria = ["id" => $idCat, "descripcion" => $desc];
        array_push($categorias, $categoria);
    }
    $jsonC = json_encode($categorias);
    echo json_encode(["data" => $jsonC]);
}

function verSubCat($mysqli)
{
    $idCat = $_POST["idCat"];
    $sql = "SELECT * from subcat where idCati='$idCat'";
    $res = $mysqli->query($sql);
    $subcats = [];
    foreach ($res as $row) {
        $id = $row["idSubCat"];
        $descripcion = $row["descripcion"];
        $subcat = ["id" => $id, "descripcion" => $descripcion];
        array_push($subcats, $subcat);
    }
    $jsonSu = json_encode($subcats);
    echo json_encode(["data" => $jsonSu]);
}

function obtenerNSecciones($mysqli)
{
    $idF = $_POST["idF"];
    $sql = "SELECT count(nombre) AS nSecc from secciones where idForo='$idF'";
    $res = $mysqli->query($sql);
    $nSecc = 0;
    foreach ($res as $resu) {
        $nSecc = $resu["nSecc"];
    }
    echo json_encode(["data" => $nSecc]);
}

?>
