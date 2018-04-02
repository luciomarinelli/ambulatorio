<?php

function scrivi ($testo,$classe="",$tag="div") {
	echo "<$tag ";
	if ($classe!="") echo "class=\"$classe\"";
	echo ">";
	echo "$testo";
	echo "</$tag>";
	}


function logga ($medico,$azione,$paziente="") {
	$adesso=time();
	$query = ("INSERT INTO log
		(timestamp,medico,azione,paziente)
		VALUES
		('$adesso','$medico','$azione','$paziente')
		");
	$result = mysql_query ($query) or die (mysql_error());
	}


function medico ($ts) {
	$tsquery="SELECT cognome FROM medici WHERE cod_ts=$ts";
	$tsresult=mysql_query ($tsquery);
	$medarray=mysql_fetch_row($tsresult);
	$medico=$medarray[0];
	return ($medico);
	}


function listitem ($arra,$item,$check) { //contenuto array, nome riga db scala, valore per il quale viene settato il check
    foreach($arra as $k => $v) {
        echo "<div>$k <input type=\"radio\" name=\"$item\" value=\"$k\" ";
        if ($k==$check) echo "checked";
        echo " />$v</div>";
    }
}


function invertidata ($data) {
	//converte GG-MM-AAAA in AAAA-MM-GG e viceversa
	$separatore=substr($data,2,1); // - se italiana
	if ($separatore == "-") {
		//la data e' in formato GG-MM-AAAA
		$giorno=substr($data,0,2);
		$mese=substr($data,3,2);
		$anno=substr($data,6,4);
		$datainvertita=$anno."-".$mese."-".$giorno;
	}
	else {
		//la data è verosimilmente in formato AAAA-MM-GG
		$giorno=substr($data,8,2);
		$mese=substr($data,5,2);
		$anno=substr($data,0,4);
		$datainvertita=$giorno."-".$mese."-".$anno;
	}
return ($datainvertita);
}


function scrivi_riga_pz ($riga,$ts,$freschi) {
//Funzione chiamata da anagrafica.php per ciascuna riga da generare. Se $freschi==1 genera le righe colorate altrimenti nere
	if ($freschi==1) {
		//seleziona il colore del nome pz in base a quanto tempo è trascorso da ultima visita
		$fresco=$riga['fresco'];
		if ($fresco>255) $fresco=255;
		$blu=dechex($fresco);
		$blu=str_pad($blu, 2, "0", STR_PAD_LEFT);  
		$rosso=dechex(255-$fresco);
		$rosso=str_pad($rosso, 2, "0", STR_PAD_LEFT); 
		$colore=$rosso."00".$blu;
		}
	else $colore="000000";

	//stampa il link
	echo "<div class=\"pz\"><a";
	echo " style=\"color: #$colore\"";
	echo " href=\"";
	echo "mod_pz.php?idpz=";
	echo $riga['idpz'];
	echo "&amp;ts=$ts\"><strong>";
	echo $riga['cognome'];
	echo " ";
	echo $riga['nome'];
	echo "</strong></a>";
	if ($riga['decesso']==0) {
		echo " di anni ";
		echo $riga['age'];
		}
	else echo "&nbsp;&#8224;"; //mostra una croce se deceduto/a
	echo "</div>";
	}


function luogo_option ($luogo) { //genera le voci del menu a tendina per scegliere il luogo della visita
	echo "<option>$luogo</option>";
}

function intestazione_report ($luogo) { //crea l'intestazione della tabella del riassunto delle visite in stat.php
	echo "<th>$luogo</th>";
}

function riga_report (&$luogo, $key) { //crea ogni riga della tabella del riassunto delle visite in stat.php
	global $report_anno;
	global $report_mese;
	$q_mese=mysql_query ("SELECT id_visita FROM visite WHERE ((FROM_UNIXTIME(data,'%Y')='$report_anno') AND (FROM_UNIXTIME(data,'%c')='$report_mese') AND (luogo='$luogo'))");
	$numerovisite=mysql_num_rows ($q_mese);
	echo "<td>$numerovisite</td>";
}


?>
