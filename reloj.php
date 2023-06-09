<?php
include_once "bloqueo.php";

$ip = empty($_SERVER["REMOTE_ADDR"]) ? "Desconocida" : $_SERVER["REMOTE_ADDR"];
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
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cuenta Regresiva - Simply Coundown JS</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>

<body>
	<main>
		<div class="contenido">
			<div class="tf">..:: Bienvenido ::..</div>
			<div id="reloj">
			</div>
			<div class="tf">Po favor espere !!!</div>
		</div>
	</main>
	<script src="js/simplyCountdown.min.js"></script>
	<script>
		simplyCountdown("#reloj", {
			year: "<?php echo $anio ?>", // required
			month: "<?php echo $mes ?>", // required
			day: "<?php echo $dia ?>", // required
			hours: "<?php echo $hora ?>", // Default is 0 [0-23] integer
			minutes: "<?php echo $minuto ?>", // Default is 0 [0-59] integer
			seconds: "<?php echo $segundo ?>", // Default is 0 [0-59] integer
			words: {
				//words displayed into the countdown
				days: {
					singular: "Días",
					plural: "Días",
				},
				hours: {
					singular: "Hora",
					plural: "Horas",
				},
				minutes: {
					singular: "Minuto",
					plural: "Minutos",
				},
				seconds: {
					singular: "Segundo",
					plural: "Segundos",
				},
			},
			plural: true, //use plurals
			inline: false, //set to true to get an inline basic countdown like : 24 days, 4 hours, 2 minutes, 5 seconds
			inlineClass: "simply-countdown-inline", //inline css span class in case of inline = true
			// in case of inline set to false
			enableUtc: false, //Use UTC or not - default : false
			onEnd: function() {
				window.location.href = "../Loginphp/index.php";
				return;
			}, //Callback on countdown end, put your own function here
			refresh: 1000, // default refresh every 1s
			sectionClass: "simply-section", //section css class
			amountClass: "simply-amount", // amount css class
			wordClass: "simply-word", // word css class
			zeroPad: false,
			countUp: false,
		});
	</script>

</body>

</html>