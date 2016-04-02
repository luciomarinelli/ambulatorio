<?php

include ("config.inc.php");

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
or die("Impossibile collegarsi al server MySQL!");

mysql_select_db($dbname,$conn)
or die("Impossibile selezionare il database $dbname!");

include ("funzioni.inc.php");

unset($_POST); //TEST

$idpz=$_GET['idpz'];
$medico=$_GET['medico']; //serve solo per registrarlo nel log

//scarica i dati anamnesi
$qanamnesi="SELECT * FROM anamnesipd WHERE idpz='$idpz'";
$result_qanamnesi = mysql_query ($qanamnesi) or die (mysql_error());
$presente=mysql_num_rows($result_qanamnesi);
$anamnesipd=mysql_fetch_assoc($result_qanamnesi);

if ($presente==1) {
    $opera="update";
    extract($anamnesipd);
  }
else $opera="insert";


//scarica informazioni su inserimento e aggiornamento dalla tabella LOG
$qlog_ins="SELECT * FROM log WHERE paziente='$idpz' AND azione='anamnesipd inserita'";
$r_qlog_ins=mysql_query($qlog_ins);
if ($log_ins=mysql_fetch_assoc($r_qlog_ins)) {
	$data_inserimento=date('j/n/Y',$log_ins['timestamp']);
	$medico_inserimento=$log_ins['medico'];
	$frase_inserimento="Creata in data $data_inserimento da $medico_inserimento";
	}

$qlog_upd="SELECT * FROM log WHERE paziente='$idpz' AND azione='anamnesipd aggiornata' AND id=(SELECT MAX(id) FROM log WHERE paziente='$idpz' GROUP BY paziente)"; // verifica che il record selezionato con MAX sia effettivamente l'ultimo in LOG una volta che ci saranno diverse operazioni!!
$r_qlog_upd=mysql_query($qlog_upd);
if ($log_upd=mysql_fetch_assoc($r_qlog_upd)) {
	$data_aggiornamento=date('j/n/Y',$log_upd['timestamp']);
	$medico_aggiornamento=$log_upd['medico'];
	$frase_aggiornamento="Aggiornata in data $data_aggiornamento da $medico_aggiornamento";
	}

?>


<html>
<head>
<title>Anamnesi del paziente parkinsoniano</title>
<meta name="author" content="Lucio Marinelli" />
<meta name="generator" content="Gedit" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" media="all" href="ambulatorio_all.css">
<link rel="stylesheet" type="text/css" media="handheld, only screen and (max-width: 640px)" href="ambulatorio_mobile.css">
</head>

<body>
<h1>Anamnesi del paziente parkinsoniano</h1>
<div><? echo "$frase_inserimento $frase_aggiornamento" ?></div>
<h3>NOTA: nei campi liberi, per indicare NESSUNA, scrivere <span style="color: red">no</span></h3>

<form action="handle_anamnesipd.php" method="post">

<input type=hidden name="idpz" value="<?=$idpz?>" />
<input type=hidden name="opera" value="<?=$opera?>" />
<input type=hidden name="medico" value="<?=$medico?>" />

<div class="form_riga"><span class="form_sn">Familiarit&agrave;: </span><input class="form_dx" type="text" name="familia" value="<?=$familia?>" required /></div>

<div class="form_riga"><span class="form_sn">Et&agrave; di esordio: </span><input class="form_dx" type="number" name="esordio_eta" value="<?=$esordio_eta?>" required /></div>

<div class="form_riga"><span class="form_sn">Sede all'esordio: </span>
<input type="radio" name="esordio_sede" value="asdx" <?php if($esordio_sede=='asdx') echo "checked"; ?> />ASdx
<input type="radio" name="esordio_sede" value="assn" <?php if($esordio_sede=='assn') echo "checked"; ?> />ASsn
<input type="radio" name="esordio_sede" value="aidx" <?php if($esordio_sede=='aidx') echo "checked"; ?> />AIdx
<input type="radio" name="esordio_sede" value="aisn" <?php if($esordio_sede=='aisn') echo "checked"; ?> />AIsn
<input type="radio" name="esordio_sede" value="altr" <?php if($esordio_sede=='altr') echo "checked"; ?> />Altro (specifica sotto)
</div>

<input class="form_dx" type="text" name="esordio_sede_txt" value="<?=$esordio_sede_txt?>" />

<div class="form_riga"><span class="form_sn">Tipo di esordio: </span>
<input type="radio" name="esordio_tipo" value="acinetico" <?php if($esordio_tipo=='acinetico') echo "checked"; ?> />Acinetico
<input type="radio" name="esordio_tipo" value="rigido" <?php if($esordio_tipo=='rigido') echo "checked"; ?> />Rigido
<input type="radio" name="esordio_tipo" value="tremorigeno" <?php if($esordio_tipo=='tremorigeno') echo "checked"; ?> />Tremorigeno
</div>

<div class="form_riga"><span class="form_sn">Data di inizio terapia (gg-mm-aaaa): </span><input class="form_dx" type="text" name="interapia_data" value="<?=invertidata($interapia_data)?>" pattern="\d{2}-\d{2}-\d{4}" /></div>

<div class="form_riga"><span class="form_sn">Prima terapia: </span>
<input type="radio" name="interapia_tipo" value="ld" <?php if($interapia_tipo=='ld') echo "checked"; ?> />Levodopa
<input type="radio" name="interapia_tipo" value="da" <?php if($interapia_tipo=='da') echo "checked"; ?> />Dopamino-agonista
<input type="radio" name="interapia_tipo" value="ac" <?php if($interapia_tipo=='ac') echo "checked"; ?> />Anticolinergici
<input type="radio" name="interapia_tipo" value="altro" <?php if($interapia_tipo=='altro') echo "checked"; ?> />Altro
</div>

<div class="form_riga"><span class="form_sn">Sintesi Anamnestica:</span><textarea class="textarea_dx" style="height: 14em" name="comorbilita"><?=$comorbilita ?></textarea></div>

<div class="form_riga"><span class="form_sn">Complicanze motorie: </span>
<input type="checkbox" name="compli_onoff" value=1 <?php if($compli_onoff==1) echo "checked"; ?> />On/Off
<input type="checkbox" name="compli_delon" value=1 <?php if($compli_delon==1) echo "checked"; ?> />Delayed on
<input type="checkbox" name="compli_woff" value=1 <?php if($compli_woff==1) echo "checked"; ?> />Wearing off
<input type="checkbox" name="compli_dysk" value=1 <?php if($compli_dysk==1) echo "checked"; ?> />Discinesie
</div>

<div class="form_riga">Altro: <input class="form_dx" type="text" name="compli_altro" value="<?=$compli_altro?>" /></div>

<div class="form_riga">Complicanze non motorie: </div>
<div class="form_riga"><span class="form_sn">&nbsp;&nbsp;-Allucinazioni: </span><input class="form_dx" type="text" name="compli_allu" value="<?=$compli_allu?>" required /></div>
<div class="form_riga"><span class="form_sn">&nbsp;&nbsp;-Disturbi del sonno: </span><input class="form_dx" type="text" name="compli_sonno" value="<?=$compli_sonno?>" required /></div>
<div class="form_riga"><span class="form_sn">&nbsp;&nbsp;-Deficit cognitivi: </span><input class="form_dx" type="text" name="compli_cogni" value="<?=$compli_cogni?>" required /></div>
<div class="form_riga"><span class="form_sn">&nbsp;&nbsp;-Disautonomia: </span><input class="form_dx" type="text" name="compli_vegeta" value="<?=$compli_vegeta?>" required /></div>

<div class="form_riga"><span class="form_sn">Esami strumentali:</span><textarea class="textarea_dx" style="height: 14em" name="esami"><?=$esami ?></textarea></div>

<div class="form_riga"><span class="form_sn">Numero di cadute nell'ultimo anno (se non cade mettere 0): </span><input class="form_dx" type="number" name="cadute" size="3,1" value="<?=$cadute?>" required /></div>

<div class="form_riga"><input class="form_dx" type="submit" name="submit" value="
<?php
if ($opera=="insert") echo "Aggiungi scheda";
else echo "Modifica scheda";
?>
" /></div>

</form>

</body>
</html>

