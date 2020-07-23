<?php
require_once ($_SERVER["DOCUMENT_ROOT"]."/Phps/dbConfig.php");
$nombreF=$_POST["nombreF"];
$direccionF=$_POST["direccionF"];
$estadoF=$_POST["estadoF"];
$nombreC=$_POST["nombreC"];
$email=$_POST["email"];
$estadoV=$_POST["estadoV"];
$ciiudadF=$_POST["ciiudadF"];
$capacidadF=$_POST["capacidadF"];
$eventosF=$_POST["eventosF"];
$boletosF=$_POST["boletosF"];
$direccionV=$_POST["direccionV"];
$cp=$_POST["cp"];
$telOf=$_POST["telOf"];
$telSec=$_POST["telSec"];
$comentarios=$_POST["comentarios"];
$adminGen=$_POST["adminGen"];
$lugarEs=$_POST["lugarEs"];
$sql="INSERT INTO `forospendientes` VALUES (null,'$nombreF','$direccionF','$ciiudadF','$estadoF',
'$capacidadF','$eventosF','$boletosF','$adminGen','$lugarEs','$nombreC',
'$email','$direccionV','$estadoV','$cp','$telOf','$telSec','$comentarios',1)";
$estado=$mysqli->query($sql);
echo json_encode(["estado"=>$estado]);
?>