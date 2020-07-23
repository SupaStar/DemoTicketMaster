<?php
function mesEsp($mes)
{
    $meses_ES = array("ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SEP", "OCT", "NOV", "DIC");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombreMes;
}

function diaEsp($dia)
{
    $dias_ES = array("LUN", "MAR", "MIÉ", "JUE", "VIE", "SÁB", "DOM");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    return $nombredia;
}