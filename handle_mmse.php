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
    $query = ("INSERT IGNORE INTO mmse (id_visita,anno,stagione,mese,gmese,gsett,stato,regione,citta,luogo,piano,capaga,tentativi,calcolo,richiamo,oggetti,ripeti,compito,occhichiusi,frase,disegno)
    VALUES ('$id','$anno','$stagione','$mese','$gmese','$gsett','$stato','$regione','$citta','$luogo','$piano','$capaga','$tentativi','$calcolo','$richiamo','$oggetti','$ripeti','$compito','$occhichiusi','$frase','$disegno')");
    if (!$result = $mysqli->query($query)) echo "Query error";
    if ($result == 1) scrivi ("Scala inserita correttamente, chiudere la finestra","corretto");
    else scrivi ("Errore durante l'inserimento della scala!","errore");
    }
else {
    $query = ("UPDATE IGNORE updrs SET anno='$anno',stagione='$stagione',mese='$mese',gmese='$gmese',gsett='$gsett',stato='$stato',regione='$regione',citta='$citta',luogo='$luogo',piano='$piano',capaga='$capaga',tentativi='$tentativi',calcolo='$calcolo',richiamo='$richiamo',oggetti='$oggetti',ripeti='$ripeti',compito='$compito',occhichiusi='$occhichiusi',frase='$frase',disegno='$disegno' WHERE id_visita='$id' ");
    if (!$result = $mysqli->query($query)) echo "Query error";
    if ($result == 1) scrivi ("Scala aggiornata correttamente, chiudere la finestra","corretto");
    else scrivi ("Errore durante l'aggiornamento della scala!","errore");
    }

?>

</body>
</html>

