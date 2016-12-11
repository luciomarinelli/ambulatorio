
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
$cognome=mysql_real_escape_string($cognome);
$nome=mysql_real_escape_string($nome);
$nascita_data=mysql_real_escape_string($nascita_data);
$nascita_luogo=mysql_real_escape_string($nascita_luogo);
$asl=mysql_real_escape_string($asl);
$telefoni=mysql_real_escape_string($telefoni);
$email=mysql_real_escape_string($email);
$domicilio=mysql_real_escape_string($domicilio);
$professione=mysql_real_escape_string($professione);
$statocivile=mysql_real_escape_string($statocivile);
$diagnosi=mysql_real_escape_string($diagnosi);
$note=mysql_real_escape_string($note);

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
$result = mysql_query ($query) or die (mysql_error());
if ($result == 1) {
	scrivi ('Paziente inserito correttamente','corretto');
	
	//recupera ultimo idpz generato dall'inserimento
	$qauto="SELECT LAST_INSERT_ID( )";
	$rauto=mysql_query($qauto);
	$ultimoauto=mysql_fetch_row($rauto);
	
	//log
	logga ($medico,"Inserito paziente",$ultimoauto[0]);
	}
else scrivi ("Errore durante l'inserimento del paziente","errore");

echo "<div class=\"comando\"><a href=\"mod_pz.php?idpz=$ultimoauto[0]&ts=$ts\">Vai alla scheda del paziente</a></div>";
echo "<div class=\"comando\"><a href=\"anagrafica.php?ts=$ts\">Ritorna all'anagrafica</a></div>";

?>

</body>
</html>
