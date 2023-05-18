<?php
require_once "config.php";
function getDatos($error, $usuario, $accion)
{
    #############################################################################
    global $pdo;
    #validar si es true o flase para pasar valor boleano 1 o 0
    $bandera = (int)(bool)$error;
    # Si no hay REMOTE_ADDR entonces ponemos "Desconocida"
    $ip = empty($_SERVER["REMOTE_ADDR"]) ? "Desconocida" : $_SERVER["REMOTE_ADDR"];
    #optenemos la fecha de la visita
    date_default_timezone_set("America/Mexico_City");
    $fechaYHora = date("Y-m-d H:i:s");
    #Ruta de acceso
    $ruta = $_SERVER['PHP_SELF'];
    # Optener Navegador
    $nos = getenv('HTTP_USER_AGENT');
    #Navegador del visitante
    if (preg_match("/MSIE/", $nos)) {
        $nav = 'Internet Explorer';
    } elseif (preg_match("/Edg/", $nos)) {
        $nav = 'Microsoft Edge';
    } elseif (preg_match("/Chrome/", $nos)) {
        $nav = 'Google Chrome o Chromium';
    } elseif (preg_match("/Mozilla/", $nos)) {
        $nav = 'Mozilla Firefox';
    } else {
        $nav = 'No identificado';
    }
    #Obtener el Sistema Operativo
    function getOs()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform = "Unknown OS Platform";
        $os_array = array(
            '/windows nt 10.0; Win64; x64; rv:109.0/i'      =>  'Windows 11',
            '/windows nt 10/i'      =>  'Windows 10 o Windows 11',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone OS',
            '/ipod/i'               =>  'iPod OS',
            '/ipad/i'               =>  'iPad OS',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }
        }
        return $os_platform;
    }
    $os = getOS();
    #$os = php_uname('s');
    ###########################################################################
    /*# Formatear mensaje para agregar al archivo Logs
        $mensaje = 'Estado: '. $bandera . ' -- La Accion fue: ' . $accion . ' -- Por el Usuario: '. $usuario .' -- Con IP: ' . $ip . ' -- Fecha: ' . $fechaYHora . ' -- Ruta:' . $ruta.' -- Navegador: ' . $nav . ' -- Sistema Operativo: '. $os . PHP_EOL;
        # Y adjuntarlo o escribirlo en logs.txt o md o logs
        file_put_contents("log.txt", $mensaje, FILE_APPEND);
        # Ya registramos la ip, ahora seguimos con el flujo normal ;)
        ###########################################################################
        ###########################################################################*/
    #Insertar datos en la base de datos
    $sql = "INSERT INTO logs (estado, accion, usuario, ip, fechaHora, ruta, navegador, os) VALUES ('$bandera', '$accion', '$usuario', '$ip', '$fechaYHora', '$ruta', '$nav', '$os')";
    $pdo->exec($sql);
    #$pdo = null;
}
