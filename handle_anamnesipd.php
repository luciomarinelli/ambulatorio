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

$interapia_data=invertidata($interapia_data);

//escape quotes
$familia=mysql_real_escape_string($familia);
$esordio_eta=mysql_real_escape_string($esordio_eta);
$esordio_sede_txt=mysql_real_escape_string($esordio_sede_txt);
$interapia_data=mysql_real_escape_string($interapia_data);
$comorbilita=mysql_real_escape_string($comorbilita);
$compli_altro=mysql_real_escape_string($compli_altro);
$compli_allu=mysql_real_escape_string($compli_allu);
$compli_sonno=mysql_real_escape_string($compli_sonno);
$compli_cogni=mysql_real_escape_string($compli_cogni);
$compli_vegeta=mysql_real_escape_string($compli_vegeta);
$esami=mysql_real_escape_string($esami);


if ($opera=="insert") {

    $query = ("INSERT INTO anamnesipd (idpz,familia,esordio_eta,esordio_sede,esordio_sede_txt,esordio_tipo,interapia_data,interapia_tipo,comorbilita,compli_onoff,compli_delon,compli_woff,compli_dysk,compli_altro,compli_allu,compli_sonno,compli_cogni,compli_vegeta,esami,cadute) VALUES ('$idpz','$familia','$esordio_eta','$esordio_sede','$esordio_sede_txt','$esordio_tipo','$interapia_data','$interapia_tipo','$comorbilita','$compli_onoff','$compli_delon','$compli_woff','$compli_dysk','$compli_altro','$compli_allu','$compli_sonno','$compli_cogni','$compli_vegeta','$esami','$cadute')");
    $result = mysql_query ($query) or die (mysql_error());
    if ($result == 1) {
	scrivi ("Anamnesi inserita correttamente, chiudere la finestra","corretto");
	logga ($medico,"anamnesipd inserita",$idpz);
	}
    else scrivi ("Errore durante l'inserimento dell'anamnesi!","errore");
    }
else {
    $query = ("UPDATE anamnesipd SET familia='$familia',esordio_eta='$esordio_eta',esordio_sede='$esordio_sede',esordio_sede_txt='$esordio_sede_txt',esordio_tipo='$esordio_tipo',interapia_data='$interapia_data',interapia_tipo='$interapia_tipo',comorbilita='$comorbilita',compli_onoff='$compli_onoff',compli_delon='$compli_delon',compli_woff='$compli_woff',compli_dysk='$compli_dysk',compli_altro='$compli_altro',compli_allu='$compli_allu',compli_sonno='$compli_sonno',compli_cogni='$compli_cogni',compli_vegeta='$compli_vegeta',esami='$esami',cadute='$cadute' WHERE idpz='$idpz' ");
    $result = mysql_query ($query) or die (mysql_error());
    if ($result == 1) {
	scrivi ("Anamnesi aggiornata correttamente, chiudere la finestra","corretto");
	logga ($medico,"anamnesipd aggiornata",$idpz);
	}
    else scrivi ("Errore durante l'aggiornamento dell'anamnesi!","errore");
    }

?>

</body>
</html>

