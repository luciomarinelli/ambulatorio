<html>
<head>
<meta charset="UTF-8" />
<meta name="author" content="Lucio Marinelli" />
<meta name="generator" content="Gedit" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" media="all" href="ambulatorio_all.css">
<link rel="stylesheet" type="text/css" media="handheld, only screen and (max-width: 640px)" href="ambulatorio_mobile.css">
</head>

<body>

<?php

require ("config.inc.php");
require ("dbconnect.inc.php");
require ("funzioni.inc.php");

extract($_POST);

$mysqli->set_charset("utf8");

//riconverti data in timestamp
$giorno=substr($data,0,2);
$mese=substr($data,3,2);
$anno=substr($data,6,4);
$datats=mktime(0,0,0,$mese,$giorno,$anno);

//escape quotes
$terapia_atto = mysqli_real_escape_string ($mysqli, $terapia_atto);
$diario = mysqli_real_escape_string ($mysqli, $diario);
$eon = mysqli_real_escape_string ($mysqli, $eon);
$terapia_data = mysqli_real_escape_string ($mysqli, $terapia_data);

$query = ("UPDATE visite SET data='$datats',luogo='$luogo',terapia_atto='$terapia_atto',diario='$diario',eon='$eon',terapia_data='$terapia_data',medico='$medico' WHERE id_visita='$idvisita' ");

if (!$result = $mysqli->query($query)) echo "Query error";
if ($result == 1) scrivi ("Visita modificata correttamente, chiudere questa finestra e ricaricare la pagina principale!","corretto");
else scrivi ("Errore durante la modifica della visita!","errore");

?>

</body>
</html>

