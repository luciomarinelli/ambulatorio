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

if ($opera=="insert") {
    $query = ("INSERT INTO mmse (id_visita,anno,stagione,mese,gmese,gsett,stato,regione,citta,luogo,piano,capaga,tentativi,calcolo,richiamo,oggetti,ripeti,compito,occhichiusi,frase,disegno)
    VALUES ('$id','$anno','$stagione','$mese','$gmese','$gsett','$stato','$regione','$citta','$luogo','$piano','$capaga','$tentativi','$calcolo','$richiamo','$oggetti','$ripeti','$compito','$occhichiusi','$frase','$disegno')");
    $result = mysql_query ($query) or die (mysql_error());
    if ($result == 1) scrivi ("Scala inserita correttamente, chiudere la finestra","corretto");
    else scrivi ("Errore durante l'inserimento della scala!","errore");
    }
else {
    $query = ("UPDATE updrs SET anno='$anno',stagione='$stagione',mese='$mese',gmese='$gmese',gsett='$gsett',stato='$stato',regione='$regione',citta='$citta',luogo='$luogo',piano='$piano',capaga='$capaga',tentativi='$tentativi',calcolo='$calcolo',richiamo='$richiamo',oggetti='$oggetti',ripeti='$ripeti',compito='$compito',occhichiusi='$occhichiusi',frase='$frase',disegno='$disegno' WHERE id_visita='$id' ");
    $result = mysql_query ($query) or die (mysql_error());
    if ($result == 1) scrivi ("Scala aggiornata correttamente, chiudere la finestra","corretto");
    else scrivi ("Errore durante l'aggiornamento della scala!","errore");
    }

?>

</body>
</html>

