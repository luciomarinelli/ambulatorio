<?php

$idvisita=$_GET['idvisita'];

require ("config.inc.php");
require ("dbconnect.inc.php");
require ("funzioni.inc.php");

$ts=$_GET['ts'];
$medico=medico($ts);

//scarica i dati
$qvisita="SELECT * FROM visite WHERE id_visita='$idvisita'";
if (!$result_qvisita = $mysqli->query($qvisita)) echo "Query error";

$visita=mysqli_fetch_assoc($result_qvisita);

?>


<html>
<head>
<title>Edita Visita</title>
<meta charset="UTF-8" />
<meta name="author" content="Lucio Marinelli" />
<meta name="generator" content="Gedit" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" media="all" href="ambulatorio_all.css">
<link rel="stylesheet" type="text/css" media="handheld, only screen and (max-width: 640px)" href="ambulatorio_mobile.css">
</head>

<body>
<h1>Edita visita</h1>

<form action="handle_editavisita.php" method="post">

<input type="hidden" name="idvisita" value="<?=$idvisita?>" />
<input type="hidden" name="medico" value="<?=$medico?>" />

<?php
//converti timestamp in data
$data=date ("d-m-Y",$visita['data']);
?>

<div class="form_riga"><span class="form_sn">Data della visita (GG-MM-AAAA): </span><input class="form_dx" type="text" name="data" value="<?=$data ?>" pattern="\d{2}-\d{2}-\d{4}" required /></div>

<div class="form_riga"><span class="form_sn">Luogo della visita:</span>
<select name="luogo">
<option><?=$visita['luogo'] ?></option>
<?php
array_walk ($lista_luoghi, luogo_option);
?>
</select></div>

<div class="form_riga"><span class="form_sn">Terapia in atto:</span><textarea class="textarea_dx" style="height: 4em" name="terapia_atto"><?=$visita['terapia_atto'] ?></textarea></div>
<div class="form_riga"><span class="form_sn">Diario:</span><textarea class="textarea_dx" style="height: 14em" name="diario"><?=$visita['diario'] ?></textarea></div>
<div class="form_riga"><span class="form_sn">Esame neurologico:</span><textarea class="textarea_dx" style="height: 10em" name="eon"><?=$visita['eon'] ?></textarea></div>
<div class="form_riga"><span class="form_sn">Terapia prescritta:</span><textarea class="textarea_dx" style="height: 4em" name="terapia_data"><?=$visita['terapia_data'] ?></textarea></div>


<div class="form_riga"><span class="form_sn"><input type="submit" name="submit" value="Modifica visita" /></div>

</form>

</body>
</html>

