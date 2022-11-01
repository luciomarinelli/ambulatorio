
<?php

require("testa.php");

extract ($_POST);

//converti data
$dataIT=explode("-",$nascita_data);
$dataslash=$dataIT[0]."/".$dataIT[1]."/".$dataIT[2];

//genera CF
include("calcolacodicefiscale.inc.php");
$r=new risultato;
$r=calcolacodicefiscale($cognome,$nome,$sesso,$nascita_luogo,$dataslash);
if (sizeof($r->errori)){
	echo "Si sono verificati i seguenti errori:<br />";
	reset ($r->errori);
	while (list ($key, $val) = each ($r->errori)) {
		echo ($key+1)."- ".$val."<br />";
	}
} else {
	$cf=$r->codicefiscale;
}		  

//escape quotes
$cognome = mysqli_real_escape_string ($mysqli, $cognome);
$nome = mysqli_real_escape_string ($mysqli, $nome);
$nascita_data = mysqli_real_escape_string ($mysqli, $nascita_data);
$nascita_luogo = mysqli_real_escape_string ($mysqli, $nascita_luogo);
$asl = mysqli_real_escape_string ($mysqli, $asl);
$telefoni = mysqli_real_escape_string ($mysqli, $telefoni);
$email = mysqli_real_escape_string ($mysqli, $email);
$domicilio = mysqli_real_escape_string ($mysqli, $domicilio);
$professione = mysqli_real_escape_string ($mysqli, $professione);
$statocivile = mysqli_real_escape_string ($mysqli, $statocivile);
$diagnosi = mysqli_real_escape_string ($mysqli, $diagnosi);
$note = mysqli_real_escape_string ($mysqli, $note);

//Capitalizza nome, cognome, comune
$cognome=ucwords($cognome);
$nome=ucwords($nome);
$nascita_luogo=ucwords($nascita_luogo);

$nascita_data=invertidata($nascita_data);

//Aggiorna dati DB
$query = ("INSERT INTO anagrafica
	(cognome,nome,nascita_data,nascita_luogo,sesso,cf,asl,telefoni,email,domicilio,professione,statocivile,diagnosi,note,ultima_visita)
	VALUES
	('$cognome','$nome','$nascita_data','$nascita_luogo','$sesso','$cf','$asl','$telefoni','$email','$domicilio','$professione','$statocivile','$diagnosi','$note',NOW())
	");
if (!$result = $mysqli->query($query)) echo "Query error";
if ($result == 1) {
	scrivi ('Paziente inserito correttamente','corretto');
	
	//recupera ultimo idpz generato dall'inserimento
	$qauto="SELECT LAST_INSERT_ID( )";
    if (!$rauto = $mysqli->query($qauto)) echo "Query error";
	$ultimoauto=mysqli_fetch_row($rauto);
	
	//log
	logga ($medico,"Inserito paziente",$ultimoauto[0]);
	}
else scrivi ("Errore durante l'inserimento del paziente","errore");

echo "<div class=\"comando\"><a href=\"mod_pz.php?idpz=$ultimoauto[0]&ts=$ts\">Vai alla scheda del paziente</a></div>";
echo "<div class=\"comando\"><a href=\"anagrafica.php?ts=$ts\">Ritorna all'anagrafica</a></div>";

?>

</body>
</html>
