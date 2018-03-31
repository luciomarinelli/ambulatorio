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

require ("config.inc.php");
require ("dbconnect.inc.php");
require ("funzioni.inc.php");

extract($_POST);

if ($opera=="insert") {
    $query = ("INSERT INTO hy (id_visita,stage)	VALUES ('$id','$rate')");
    $result = mysql_query ($query) or die (mysql_error());
    if ($result == 1) scrivi ("Scala inserita correttamente, chiudere la finestra","corretto");
    else scrivi ("Errore durante l'inserimento della scala!","errore");
    }
else {
    $query = ("UPDATE hy SET stage='$rate' WHERE id_visita='$id' ");
    $result = mysql_query ($query) or die (mysql_error());
    if ($result == 1) scrivi ("Scala aggiornata correttamente, chiudere la finestra","corretto");
    else scrivi ("Errore durante l'aggiornamento della scala!","errore");
    }

?>

</body>
</html>

