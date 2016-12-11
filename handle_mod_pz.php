
<?php

require("testa.php");

extract ($_POST);

$nascita_data=invertidata($nascita_data);

//escape quotes
$cognome=mysql_real_escape_string($cognome);
$nome=mysql_real_escape_string($nome);
$nascita_data=mysql_real_escape_string($nascita_data);
$nascita_luogo=mysql_real_escape_string($nascita_luogo);
$cf=mysql_real_escape_string($cf);
$asl=mysql_real_escape_string($asl);
$telefoni=mysql_real_escape_string($telefoni);
$email=mysql_real_escape_string($email);
$domicilio=mysql_real_escape_string($domicilio);
$professione=mysql_real_escape_string($professione);
$statocivile=mysql_real_escape_string($statocivile);
$diagnosi=mysql_real_escape_string($diagnosi);
$note=mysql_real_escape_string($note);

//Aggiorna dati DB
$query = ("UPDATE anagrafica SET
	cognome='$cognome',
	nome='$nome',
	nascita_data='$nascita_data',
	nascita_luogo='$nascita_luogo',
	sesso='$sesso',
	cf='$cfnew',
	asl='$asl',
	telefoni='$telefoni',
	email='$email',
	domicilio='$domicilio',
	professione='$professione',
	statocivile='$statocivile',
	diagnosi='$diagnosi',
	note='$note',
	decesso='$decesso'
	WHERE idpz='$idpz' ");
$result = mysql_query ($query) or die (mysql_error());
if ($result == 1) {
	scrivi ("Anagrafica aggiornata correttamente","corretto");
	logga ($medico,"Anagrafica aggiornata",$idpz);
	}
else scrivi ("Errore durante l'aggiornamento dell'anagrafica","errore");

echo "<div class=\"comando\"><a href=\"mod_pz.php?idpz=$idpz&ts=$ts\">Vai alla scheda del paziente</a></div>";

echo "<div class=\"comando\"><a href=\"anagrafica.php?ts=$ts\">Ritorna all'anagrafica</a></div>";

?>

</body>
</html>
