<?php

require ("config.inc.php");
require ("dbconnect.inc.php");
require ("funzioni.inc.php");

unset($_POST); //altrimenti non funziona il POST all'interno del popup...

$scalalink=$_GET['scala']; //nome tabella e file da includere della scala
$id=$_GET['id']; //numero della visita, di conseguenza unico anche per il paziente
$idpz=$_GET['idpz']; //codice fiscale serve per la query x mettere di default i valori dell'ultima updrs

//ottieni descrizione della scala prescelta
$qlistascale="SELECT * FROM listascale WHERE link='$scalalink'";
$result_qlistascale=mysql_query($qlistascale) or die (mysql_error());
$scala=mysql_fetch_assoc($result_qlistascale);
$scalalong=$scala['descrizione'];
$filescala=$scala['link'].".inc.php";
?>

<html>
<head>
<title><?=$scalalong ?></title>
<meta name="author" content="Lucio Marinelli" />
<meta name="generator" content="Gedit" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" media="all" href="ambulatorio_all.css">
<link rel="stylesheet" type="text/css" media="handheld, only screen and (max-width: 640px)" href="ambulatorio_mobile.css">
</head>

<body>
<h1><?=$scalalong ?></h1>

<?php

require($filescala);

?>

</body>
</html>

