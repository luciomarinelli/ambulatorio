
<?php

require("testa.php");

extract ($_POST);
$adesso=time();

//escape quotes
$terapia_atto=mysql_real_escape_string($terapia_atto);
$diario=mysql_real_escape_string($diario);
$eon=mysql_real_escape_string($eon);
$terapia_data=mysql_real_escape_string($terapia_data);

//Trova nome medico
$tsquery="SELECT cognome FROM medici WHERE cod_ts=$ts";
$tsresult=mysql_query ($tsquery);
$medarray=mysql_fetch_row($tsresult);
$medico=$medarray[0];

//Aggiungi visita in DB
$query = ("INSERT INTO visite
	(idpz,data,luogo,terapia_atto,diario,eon,terapia_data,medico)
	VALUES
	('$idpz','$adesso','$luogo','$terapia_atto','$diario','$eon','$terapia_data','$medico')
	");
$result = mysql_query ($query) or die (mysql_error());
if ($result == 1) {
	scrivi ("Visita inserita correttamente","corretto");
	logga ($medico,"Inserita visita",$idpz);
	}
else scrivi ("Errore durante l'inserimento della visita","errore");


//Aggiorna ultima_visita in anagrafica
$result_ultima_visita= mysql_query ("UPDATE anagrafica SET ultima_visita=NOW() WHERE idpz='$idpz'");


echo "<div class=\"comando\"><a href=\"mod_pz.php?idpz=$idpz&ts=$ts\">Vai alla scheda del paziente</a></div>";
echo "<div class=\"comando\"><a href=\"anagrafica.php?ts=$ts\">Ritorna all'anagrafica</a></div>";

?>

</body>
</html>
