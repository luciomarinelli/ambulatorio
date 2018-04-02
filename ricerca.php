<?php

require("testa.php");

require("controllo.inc.php");

$criteri=array(); //crea array dove appendere i criteri di ricerca della query

// per ciascun campo verifica la validità e crea una chiave omonima nell'array $criteri
if (is_numeric($_POST['eta_min'])) {
	$rtemp="(DATEDIFF(NOW(),nascita_data)/365.25 >= ".$_POST['eta_min'].")";
	array_push ($criteri, $rtemp);
	echo "<div>Criterio: ".$rtemp."</div>";
	}

if (is_numeric($_POST['eta_max'])) {
	$rtemp="(DATEDIFF(NOW(),nascita_data)/365.25 <= ".$_POST['eta_max'].")";
	array_push ($criteri, $rtemp);
	echo "<div>Criterio: ".$rtemp."</div>";
	}

if ($_POST['sesso']=="m" || $_POST['sesso']=="f") {
	$rtemp="sesso='".$_POST['sesso']."'";
	array_push ($criteri, $rtemp);
	echo "<div>Criterio: ".$rtemp."</div>";
	}

if ($_POST['familia']=="s" || $_POST['familia']=="n") {
	if ($_POST['familia']=="n") $rtemp="familia='no'";
	else $rtemp="familia <>'' && familia <>'no'";
	array_push ($criteri, $rtemp);
	echo "<div>Criterio: ".$rtemp."</div>";
	}

if (is_numeric($_POST['esordio_eta_min'])) {
	$rtemp="esordio_eta>=".$_POST['esordio_eta_min'];
	array_push ($criteri, $rtemp);
	echo "<div>Criterio: ".$rtemp."</div>";
	}

if (is_numeric($_POST['esordio_eta_max'])) {
	$rtemp="esordio_eta<=".$_POST['esordio_eta_max']." && esordio_eta>0";
	array_push ($criteri, $rtemp);
	echo "<div>Criterio: ".$rtemp."</div>";
	}

if ($_POST['esordio_sede']!="") {
	$rtemp="esordio_sede='".$_POST['esordio_sede']."'";
	array_push ($criteri, $rtemp);
	echo "<div>Criterio: ".$rtemp."</div>";
	}

if ($_POST['esordio_tipo']!="") {
	$rtemp="esordio_tipo='".$_POST['esordio_tipo']."'";
	array_push ($criteri, $rtemp);
	echo "<div>Criterio: ".$rtemp."</div>";
	}

if ($_POST['interapia_tipo']!="") {
	$rtemp="interapia_tipo='".$_POST['interapia_tipo']."'";
	array_push ($criteri, $rtemp);
	echo "<div>Criterio: ".$rtemp."</div>";
	}

if (is_numeric($_POST['cadute_min'])) {
	$rtemp="cadute>=".$_POST['cadute_min'];
	array_push ($criteri, $rtemp);
	echo "<div>Criterio: ".$rtemp."</div>";
	}

if (is_numeric($_POST['cadute_max'])) {
	$rtemp="cadute<=".$_POST['cadute_max'];
	array_push ($criteri, $rtemp);
	echo "<div>Criterio: ".$rtemp."</div>";
	}


// conta quanti campi sono stati inseriti nell'array e li processa uno ad uno per creare la query
$rconta= count ($criteri);

if ($rconta>0) {
	//primo pezzo (peculiare)
	$rquery=$criteri[0];
	//pezzi restanti
	if ($rconta>1) {
		for ($i=1; $i<=$rconta-1; $i++) {
			$rquery=$rquery." && ".$criteri[$i];
			}
		}
	$query="SELECT * FROM anagrafica INNER JOIN anamnesipd ON anagrafica.idpz = anamnesipd.idpz WHERE $rquery ORDER BY cognome";
	$result = mysql_query ($query) or die (mysql_error());
	echo "<table>";
	$pz_trovati=mysql_num_rows($result);
	echo "<tr><th>Con questi criteri di ricerca i pazienti trovati sono: ".$pz_trovati."</th></tr>";
	while ($riga = mysql_fetch_assoc($result)) {
		echo "<tr><td><a href=\"mod_pz.php?idpz=".$riga['idpz']."&amp;ts=$ts\">".$riga['cognome']." ".$riga['nome']."</a></td></tr>\n";
		}
	echo "</table>";
	}

?>

<form action="ricerca.php" method="post" style="margin-top: 20px">

<input type="hidden" name="ts" value="<?=$ts?>" />
<input type="hidden" name="medico" value="<?=$medico?>" />

<table style="margin-top: 5em">

<tr><td>Et&agrave; minima: </td><td><input type="number" name="eta_min" size="3,1" /></td></tr>
<tr><td>Et&agrave; massima: </td><td><input type="number" name="eta_max" size="3,1" /></td></tr>
<tr><td>Sesso: </td><td>
<input type="radio" name="sesso" value="m" />Maschile
<input type="radio" name="sesso" value="f" />Femminile
</td></tr>
<tr><td>Familiarit&agrave;: </td><td>
<input type="radio" name="familia" value="s" />Si (o dubbia)
<input type="radio" name="familia" value="n" />No
</td></tr>
<tr><td>Et&agrave; di esordio minima: </td><td><input type="number" name="esordio_eta_min" size="3,1" /></td></tr>
<tr><td>Et&agrave; di esordio massima: </td><td><input type="number" name="esordio_eta_max" size="3,1" /></td></tr>
<tr><td>Sede all'esordio: </td><td>
<input type="radio" name="esordio_sede" value="asdx" />ASdx
<input type="radio" name="esordio_sede" value="assn" />ASsn
<input type="radio" name="esordio_sede" value="aidx" />AIdx
<input type="radio" name="esordio_sede" value="aisn" />AIsn
<input type="radio" name="esordio_sede" value="altr" />Altro
</td></tr>
<tr><td>Tipo di esordio: </td><td>
<input type="radio" name="esordio_tipo" value="acinetico" />Acinetico
<input type="radio" name="esordio_tipo" value="rigido" />Rigido
<input type="radio" name="esordio_tipo" value="tremorigeno" />Tremorigeno
</td></tr>
<tr><td>Prima terapia: </td><td>
<input type="radio" name="interapia_tipo" value="ld" />Levodopa
<input type="radio" name="interapia_tipo" value="da" />Dopamino-agonista
<input type="radio" name="interapia_tipo" value="ac" />Anticolinergici
<input type="radio" name="interapia_tipo" value="altro" />Altro
</td></tr>
<tr><td>Numero cadute minime nell'ultimo anno: </td><td><input type="number" name="cadute_min" size="3,1" /></td></tr>
<tr><td>Numero di cadute massime nell'ultimo anno: </td><td><input type="number" name="cadute_max" size="3,1" /></td></tr>

<tr><td></td><td><input type="submit" value="cerca" /> <input type="reset" value="cancella" /></td></tr>
</table>

</body>
</html>
