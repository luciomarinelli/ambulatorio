
<?php

require("testa.php");

extract ($_POST);
$adesso=time();

//escape quotes
$terapia_atto = mysqli_real_escape_string ($mysqli, $terapia_atto);
$diario = mysqli_real_escape_string ($mysqli, $diario);
$eon = mysqli_real_escape_string ($mysqli, $eon);
$terapia_data = mysqli_real_escape_string ($mysqli, $terapia_data);

//Trova nome medico
$tsquery="SELECT cognome FROM medici WHERE cod_ts=$ts";
if (!$tsresult = $mysqli->query($tsquery)) echo "Query error";
$medarray=mysqli_fetch_row($tsresult);
$medico=$medarray[0];

//Aggiungi visita in DB
$query = ("INSERT INTO visite
	(idpz,data,luogo,terapia_atto,diario,eon,terapia_data,medico)
	VALUES
	('$idpz','$adesso','$luogo','$terapia_atto','$diario','$eon','$terapia_data','$medico')
	");
if (!$result = $mysqli->query($query)) echo "Query error";
if ($result == 1) {
	scrivi ("Visita inserita correttamente","corretto");
	logga ($medico,"Inserita visita",$idpz);
	}
else scrivi ("Errore durante l'inserimento della visita","errore");


//Aggiorna ultima_visita in anagrafica
if (!$result_ultima_visita = $mysqli->query("UPDATE anagrafica SET ultima_visita=NOW() WHERE idpz='$idpz'")) echo "Query error";


echo "<div class=\"comando\"><a href=\"mod_pz.php?idpz=$idpz&ts=$ts\">Vai alla scheda del paziente</a></div>";
echo "<div class=\"comando\"><a href=\"anagrafica.php?ts=$ts\">Ritorna all'anagrafica</a></div>";

?>

</body>
</html>
