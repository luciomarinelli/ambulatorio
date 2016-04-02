
<?php

require("testa.php");

require("controllo.inc.php");

$query = ("SELECT idpz,cognome,nome,nascita_data,DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(nascita_data)), '%Y')+0 AS age,(TO_DAYS(NOW())-TO_DAYS(ultima_visita)) AS fresco FROM anagrafica WHERE decesso=0 ORDER BY cognome");
$result = mysql_query ($query) or die (mysql_error());

echo "<div class=\"pzframe\" id=\"vecchi\">";
//scrive un link per ogni paziente

$conta=0; //azzera contatore pazienti attuali

while ($riga = mysql_fetch_assoc($result)) {
	if (($riga['fresco']>730)) {
		scrivi_riga_pz($riga,$ts,0); //mostra i pazienti visti da più di due anni
		$conta++;
		}
	}

echo "<div class=\"conteggio\">$conta pazienti visti da oltre 2 anni</div>";

echo "</div>";


?>


</body>
</html>
