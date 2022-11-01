<?php

require("testa.php");

require("controllo.inc.php");

$query = ("SELECT idpz,cognome,nome,decesso,nascita_data FROM anagrafica WHERE decesso=1 ORDER BY cognome");
if (!$result = $mysqli->query($query)) echo "Query error";

echo "<div class=\"pzframe\" id=\"vecchi\">";
//scrive un link per ogni paziente

$conta=0; //azzera contatore pazienti attuali

while ($riga = mysqli_fetch_assoc($result)) {
	scrivi_riga_pz($riga,$ts,0); //mostra i pazienti deceduti
	echo "\n";
	$conta++;
	}

echo "<div class=\"conteggio\">$conta pazienti deceduti</div>";

echo "</div>";


?>


</body>
</html>
