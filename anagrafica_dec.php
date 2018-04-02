<?php

require("testa.php");

require("controllo.inc.php");

$query = ("SELECT idpz,cognome,nome,decesso,nascita_data FROM anagrafica WHERE decesso=1 ORDER BY cognome");
$result = mysql_query ($query) or die (mysql_error());

echo "<div class=\"pzframe\" id=\"vecchi\">";
//scrive un link per ogni paziente

$conta=0; //azzera contatore pazienti attuali

while ($riga = mysql_fetch_assoc($result)) {
	scrivi_riga_pz($riga,$ts,0); //mostra i pazienti deceduti
	echo "\n";
	$conta++;
	}

echo "<div class=\"conteggio\">$conta pazienti deceduti</div>";

echo "</div>";


?>


</body>
</html>
