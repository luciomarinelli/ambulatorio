<?php

require("testa.php");

require("controllo.inc.php");


//conta numero di records
if (!$qconteggio = $mysqli->query("SELECT * FROM anagrafica")) echo "Query error";
$conteggio=mysqli_num_rows ($qconteggio);

if (!$qnumvisite = $mysqli->query("SELECT * FROM visite")) echo "Query error";
$numvisite=mysqli_num_rows ($qnumvisite);

echo "<div class=\"conteggio\">$conteggio pazienti presenti nel database, $numvisite visite inserite</div>";


//conta numero di visite divise per LUOGO nei mesi dell'anno in corso e del precedente (tabella con mesi nelle righe e luoghi nelle colonne)

//anno della prima visita presente nel database
if (!$q_min_anno = $mysqli->query("SELECT FROM_UNIXTIME(data,'%Y') FROM visite WHERE data=(SELECT MIN(data) FROM visite)")) echo "Query error";
$min_anno=mysqli_fetch_row ($q_min_anno);
$min_anno=$min_anno[0];

//anno attuale
$anno_attuale=date('Y');
if ($_POST['report_anno']=="") $report_anno=$anno_attuale;
else $report_anno=$_POST['report_anno'];

//crea drop down menu per scegliere l'anno
echo "<h2>Riassunto delle visite per anno</h2>";
echo "<form action=\"stat.php?ts=$ts\" method=\"post\" style=\"text-align: center; margin-top: 20px\">";
echo "<select name=\"report_anno\">";
$menu_anno=$anno_attuale;
while ($menu_anno >= $min_anno) {
	echo "<option value=\"$menu_anno\" ";
	if ($menu_anno==$report_anno) echo "selected";
	echo" >$menu_anno</option>";
	$menu_anno--;
}
echo "</select>";
echo "<input type=\"submit\" name=\"submit\" value=\"Scegli anno\" /></form>";
echo "<table border=\"1px\" align=\"center\">";
echo "<tr>";
echo "<th></th>";
array_walk ($lista_luoghi, 'intestazione_report');
echo "</tr>";

for ($report_mese=1;$report_mese<13;$report_mese++) {
echo "<tr>";
switch ($report_mese) {
	case 1:
		echo "<td>Gennaio</td>";
		break;
	case 2:
		echo "<td>Febbraio</td>";
		break;
	case 3:
		echo "<td>Marzo</td>";
		break;
	case 4:
		echo "<td>Aprile</td>";
		break;
	case 5:
		echo "<td>Maggio</td>";
		break;
	case 6:
		echo "<td>Giugno</td>";
		break;
	case 7:
		echo "<td>Luglio</td>";
		break;
	case 8:
		echo "<td>Agosto</td>";
		break;
	case 9:
		echo "<td>Settembre</td>";
		break;
	case 10:
		echo "<td>Ottobre</td>";
		break;
	case 11:
		echo "<td>Novembre</td>";
		break;
	case 12:
		echo "<td>Dicembre</td>";
		break;
}

array_walk ($lista_luoghi, 'riga_report');
echo "</tr>";
}
echo "</table>";



//riporta gli ultimi 20 record del log
$q_logread = ("SELECT * FROM log ORDER BY timestamp DESC");
if (!$r_logread= $mysqli->query($q_logread)) echo "Query error";

echo "<h2>Ultime 20 operazioni nel log</h2><table border=\"1px\" align=\"center\">";
echo "<tr><th>Timestamp</th><th>Utente</th><th>Azione</th><th>Paziente</th></tr>";

for ($contatore=1;$contatore<21;$contatore++) {
	$rigalog = mysqli_fetch_assoc($r_logread);
	$rigalog['timestamp']=date('r',$rigalog['timestamp']); //Converti timestamp
	if ($rigalog['paziente']!="") { //converte numero del paziente in cognome e nome
		$numeropz=$rigalog['paziente'];
        if (!$r_convertipz = $mysqli->query("SELECT cognome,nome FROM anagrafica WHERE idpz='$numeropz'")) echo "Query error";
		$nomepz=mysqli_fetch_assoc($r_convertipz);
		$nomepz_formattato=$nomepz['cognome']." ".$nomepz['nome'];
		}
	else $nomepz_formattato="";
	echo "<tr><td>$rigalog[timestamp]</td><td>$rigalog[medico]</td><td>$rigalog[azione]</td><td>$nomepz_formattato</td></tr>";
	}

echo "</table>";

?>

</body>
</html>
