
<?php

require("testa.php");

extract ($_POST);

$nascita_data=invertidata($nascita_data);

//escape quotes
$cognome = mysqli_real_escape_string ($mysqli, $cognome);
$nome = mysqli_real_escape_string ($mysqli, $nome);
$nascita_data = mysqli_real_escape_string ($mysqli, $nascita_data);
$nascita_luogo = mysqli_real_escape_string ($mysqli, $nascita_luogo);
$cf = mysqli_real_escape_string ($mysqli, $cf);
$asl = mysqli_real_escape_string ($mysqli, $asl);
$telefoni = mysqli_real_escape_string ($mysqli, $telefoni);
$email = mysqli_real_escape_string ($mysqli, $email);
$domicilio = mysqli_real_escape_string ($mysqli, $domicilio);
$professione = mysqli_real_escape_string ($mysqli, $professione);
$statocivile = mysqli_real_escape_string ($mysqli, $statocivile);
$diagnosi = mysqli_real_escape_string ($mysqli, $diagnosi);
$note = mysqli_real_escape_string ($mysqli, $note);
if (!$decesso == 1) $decesso = 0;

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

if (!$result = $mysqli->query($query)) echo "Query error";
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
