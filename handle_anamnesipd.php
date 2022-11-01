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

$interapia_data=invertidata($interapia_data);

//escape quotes
$familia = mysqli_real_escape_string ($mysqli, $familia);
$esordio_eta = mysqli_real_escape_string ($mysqli, $esordio_eta);
$esordio_sede_txt = mysqli_real_escape_string ($mysqli, $esordio_sede_txt);
$interapia_data = mysqli_real_escape_string ($mysqli, $interapia_data);
$comorbilita = mysqli_real_escape_string ($mysqli, $comorbilita);
$compli_altro = mysqli_real_escape_string ($mysqli, $compli_altro);
$compli_allu = mysqli_real_escape_string ($mysqli, $compli_allu);
$compli_sonno = mysqli_real_escape_string ($mysqli, $compli_sonno);
$compli_cogni = mysqli_real_escape_string ($mysqli, $compli_cogni);
$compli_vegeta = mysqli_real_escape_string ($mysqli, $compli_vegeta);
$esami = mysqli_real_escape_string ($mysqli, $esami);


if ($opera=="insert") {

// l'uso di IGNORE evita errori in mancanza di valori nei campi numerici ma inserisce automaticamente gli 0

    $query = ("INSERT IGNORE INTO anamnesipd (idpz,familia,esordio_eta,esordio_sede,esordio_sede_txt,esordio_tipo,interapia_data,interapia_tipo,comorbilita,compli_onoff,compli_delon,compli_woff,compli_dysk,compli_altro,compli_allu,compli_sonno,compli_cogni,compli_vegeta,esami,cadute) VALUES ('$idpz','$familia','$esordio_eta','$esordio_sede','$esordio_sede_txt','$esordio_tipo','$interapia_data','$interapia_tipo','$comorbilita','$compli_onoff','$compli_delon','$compli_woff','$compli_dysk','$compli_altro','$compli_allu','$compli_sonno','$compli_cogni','$compli_vegeta','$esami','$cadute')");
//DEBUG

    if (!$result = $mysqli->query($query)) echo "Query error";    
    if ($result == 1) {
	scrivi ("Anamnesi inserita correttamente, chiudere la finestra","corretto");
	logga ($medico,"anamnesipd inserita",$idpz);
	}
    else scrivi ("Errore durante l'inserimento dell'anamnesi!","errore");
    }
else {
    $query = ("UPDATE IGNORE anamnesipd SET familia='$familia',esordio_eta='$esordio_eta',esordio_sede='$esordio_sede',esordio_sede_txt='$esordio_sede_txt',esordio_tipo='$esordio_tipo',interapia_data='$interapia_data',interapia_tipo='$interapia_tipo',comorbilita='$comorbilita',compli_onoff='$compli_onoff',compli_delon='$compli_delon',compli_woff='$compli_woff',compli_dysk='$compli_dysk',compli_altro='$compli_altro',compli_allu='$compli_allu',compli_sonno='$compli_sonno',compli_cogni='$compli_cogni',compli_vegeta='$compli_vegeta',esami='$esami',cadute='$cadute' WHERE idpz='$idpz' ");
    if (!$result = $mysqli->query($query)) echo "Query error";    
    if ($result == 1) {
	scrivi ("Anamnesi aggiornata correttamente, chiudere la finestra","corretto");
	logga ($medico,"anamnesipd aggiornata",$idpz);
	}
    else scrivi ("Errore durante l'aggiornamento dell'anamnesi!","errore");
    }

?>

</body>
</html>

