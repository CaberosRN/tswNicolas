<?php
require_once "config.php";
function selectBloq($ip)
{
    global $pdo;
    #$sql = "SELECT COUNT(*) total FROM logs WHERE ip='$ip' and estado=0;";
    #$result = $pdo->query($sql); //$pdo sería el objeto conexión
    #$total = $result->fetchColumn();
    #return $total;
    date_default_timezone_set("America/Mexico_City");
    $mifecha = date('Y-m-d H:i:s');
    $mif = mktime(date("H") - 1);
    $mif = date('Y-m-d H:i:s', $mif);
    $sql = "SELECT COUNT(*) total FROM logs WHERE ip='$ip' and estado=0 and fechaHora BETWEEN '$mif' AND '$mifecha';";
    $result = $pdo->query($sql); //$pdo sería el objeto conexión
    $total = $result->fetchColumn();
    #$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $total;
}

function getFecha($ip, $fM, $fA)
{
    global $pdo;
    $sql = "SELECT Min(fechaHora) total FROM logs WHERE ip='$ip' and estado=0 and fechaHora BETWEEN '$fM' AND '$fA';";
    $result = $pdo->query($sql); //$pdo sería el objeto conexión
    $total = $result->fetchColumn();
    return $total;
}

function tiempo($ip)
{
    date_default_timezone_set("America/Mexico_City");
    $fechaActual = date('Y-m-d H:i:s');
    $fechaMenos = mktime(date("H") - 1);
    $fechaMenos = date('Y-m-d H:i:s', $fechaMenos);
    $f = getFecha($ip, $fechaMenos, $fechaActual);
    return $f;
}
##############################################################################################
/*
function actBloq($ip)
{
    global $pdo;
    $sql = "UPDATE logs SET ip = '$ip-f' WHERE ip = '$ip' and estado='0';";
    $pdo->exec($sql);
}

function actualizar($email, $intento, $hora)
{
    global $pdo;
    $sql = "UPDATE users SET intento = '$intento', hora = '$hora' WHERE email = '$email';";
    $pdo->exec($sql);
    #$pdo = null;
}


*/