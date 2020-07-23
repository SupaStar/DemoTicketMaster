<?php
$mysqli = new mysqli("localhost", "root", "", "Proyecto");
//$mysqli = new mysqli("localhost", "id10193683_root", "obednoe1", "id10193683_proyecto");
if ($mysqli->connect_errno) {
    echo false;
    return;
}
?>