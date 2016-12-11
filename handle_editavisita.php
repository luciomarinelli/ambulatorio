<html>
<head>
<meta name="author" content="Lucio Marinelli" />
<meta name="generator" content="Gedit" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" media="all" href="ambulatorio_all.css">
<link rel="stylesheet" type="text/css" media="handheld, only screen and (max-width: 640px)" href="ambulatorio_mobile.css">
</head>

<body>

<?php

include ("config.inc.php");

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
or die("Impossibile collegarsi al server MySQL!");

mysql_select_db($dbname,$conn)
or die("Impossibile selezionare il database $dbname!");

include ("funzioni.inc.php");

extract($_POST);

//riconverti data in timestamp
$giorno=substr($data,0,2);
$mese=substr($data,3,2);
$anno=substr($data,6,4);
$datats=mktime(0,0,0,$mese,$giorno,$anno);

//escape quotes
$terapia_atto=mysql_real_escape_string($terapia_atto);
$diario=mysql_real_escape_string($diario);
$eon=mysql_real_escape_string($eon);
$terapia_data=mysql_real_escape_string($terapia_data);

$query = ("UPDATE visite SET data='$datats',luogo='$luogo',terapia_atto='$terapia_atto',diario='$diario',eon='$eon',terapia_data='$terapia_data',medico='$medico' WHERE id_visita='$idvisita' ");

$result = mysql_query ($query) or die (mysql_error());
if ($result == 1) scrivi ("Visita modificata correttamente, chiudere questa finestra e ricaricare la pagina principale!","corretto");
else scrivi ("Errore durante la modifica della visita!","errore");

?>

</body>
</html>

