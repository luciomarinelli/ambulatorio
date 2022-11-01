<?php

require("testa.php");

require("controllo.inc.php");

$query = ("SELECT idpz,cognome,nome,nascita_data,DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(nascita_data)), '%Y')+0 AS age,(TO_DAYS(NOW())-TO_DAYS(ultima_visita)) AS fresco FROM anagrafica WHERE decesso=0 ORDER BY cognome");
if (!$result = $mysqli->query($query)) echo "Query error";

echo "<div class=\"pzframe\">";
//scrive un link per ogni paziente

$conta=0; //azzera contatore pazienti attuali

while ($riga = mysqli_fetch_assoc($result)) {
	if ($riga['fresco'] <=730) {
		scrivi_riga_pz($riga,$ts,1); //mostra prima solo i pazienti visti da meno di due anni
		echo "\n";
		$conta++;
		}
	}

echo "<div class=\"conteggio\">$conta pazienti visti negli ultimi 2 anni</div>";

echo "</div>";

echo "<div style=\"text-align: center\"> <a href=\"anagrafica_old.php?ts=$ts\">Pazienti visti da pi&ugrave; di due anni</a></div>";
echo "<div style=\"text-align: center; margin: 2em 0em 2em 0em\"> <a href=\"anagrafica_dec.php?ts=$ts\">Pazienti deceduti&nbsp;&#8224;</a></div>";

?>


</body>
</html>
