<?php
require_once "bloqueo.php";

$ip = empty($_SERVER["REMOTE_ADDR"]) ? "Desconocida" : $_SERVER["REMOTE_ADDR"];
if (selectBloq($ip) >= 3) {
    $fecha = tiempo($ip);
    date_default_timezone_set("America/Mexico_City");
    $mifecha = date('Y-m-d H:i:s');
    $fechaMin = new DateTime($fecha);
    $fechaMax = new DateTime($mifecha);
    $diff = $fechaMin->diff($fechaMax);
    if ($diff->h > 0) {
        header("Location: index.php");
        exit;
    } else {
        $fechaEntera = strtotime($fecha);
        $anio = date("Y", $fechaEntera);
        $mes = date("m", $fechaEntera);
        $dia = date("d", $fechaEntera);
        $hora = date("H", $fechaEntera);
        $hora = $hora + 1;
        $minuto = date("i", $fechaEntera);
        $segundo = date("s", $fechaEntera);
        header("Location: reloj.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
