<?php
require_once ($_SERVER["DOCUMENT_ROOT"]."/Phps/dbConfig.php");
$nombre=$_POST['nombre'];
$apPaterno=$_POST['apPaterno'];
$apMaterno=$_POST['apMaterno'];
$correo=$_POST['correo'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);
$sql="Insert into usuarios(nombre, apPaterno, apMaterno, correo, password,rol) 
VALUES ('$nombre','$apPaterno','$apMaterno','$correo','$password',1)";
$estado=$mysqli->query($sql);
echo json_encode(["estado"=>$estado]);
?>