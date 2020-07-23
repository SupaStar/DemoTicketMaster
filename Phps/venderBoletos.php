<?php
require_once ($_SERVER["DOCUMENT_ROOT"]."/Phps/dbConfig.php");
$nombreE=$_POST["nombreE"];
$fechaventa=$_POST["fechaventa"];
$nombreF=$_POST["nombreF"];
$capacidadF=$_POST["capacidadF"];
$boletosV=$_POST["boletosV"];
$costoB=$_POST["costoB"];
$taquilla=$_POST["taquilla"];
$admisionG=$_POST["admisionG"];
$lugarE=$_POST["lugarE"];
$nombreC=$_POST["nombreC"];
$email=$_POST["email"];
$direccion=$_POST["direccion"];
$estado=$_POST["estado"];
$cp=$_POST["cp"];
$telC=$_POST["telC"];
$telSec=$_POST["telSec"];
$comentarios=$_POST["comentarios"];
$sql="INSERT INTO `eventospendientes` VALUES (null,'$nombreE','$fechaventa','$nombreF','$capacidadF',
'$boletosV','$costoB','$taquilla','$admisionG','$lugarE','$nombreC','$email','$direccion',
'$estado','$cp','$telC','$telSec','$comentarios',1)";
$estado=$mysqli->query($sql);
echo json_encode(["estado"=>$estado]);
?>