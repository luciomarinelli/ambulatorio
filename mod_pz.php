<?php
require("testa.php");

require("controllo.inc.php");

$idpz=$_GET['idpz'];

if ($idpz!="nuovo"):
	//Inizia procedura recupero per visualizzazione o modifica dati
	$query = ("SELECT cognome,nome,nascita_data,nascita_luogo,sesso,cf,asl,telefoni,email,domicilio,professione,statocivile,diagnosi,note,decesso FROM anagrafica WHERE idpz='$idpz' ");
	if (!$result = $mysqli->query($query)) echo "Query error";
	$riga = mysqli_fetch_assoc($result);
?>

<form action="handle_mod_pz.php" method="post">

<input type="hidden" name="idpz" value="<?=$idpz?>" />
<input type="hidden" name="ts" value="<?=$ts?>" />
<input type="hidden" name="medico" value="<?=$medico?>" />

<div class="form_riga"><span class="form_sn">Cognome: </span><input class="form_dx" type="text" name="cognome" value="<?=$riga['cognome']?>" required /></div>

<div class="form_riga"><span class="form_sn">Nome: </span><input class="form_dx" type="text" name="nome" value="<?=$riga['nome']?>" required /></div>

<div class="form_riga"><span class="form_sn">Data di nascita (gg-mm-aaaa): </span><input class="form_dx" type="text" name="nascita_data" value="<?=invertidata($riga['nascita_data'])?>" pattern="\d{2}-\d{2}-\d{4}" required /></div>

<div class="form_riga"><span class="form_sn">Comune di nascita: </span><input class="form_dx" type="text" name="nascita_luogo" value="<?=$riga['nascita_luogo']?>" required /></div>

<div class="form_riga"><span class="form_sn">Sesso: </span><span class="form_dx">
<?php
if ($riga['sesso'] == 'm'):
?>
<input type="radio" name="sesso" value="m" checked />M<input type="radio" name="sesso" value="f"/>F&nbsp;&nbsp;&nbsp;&nbsp; Deceduto: 
<?php
else:
?>
<input type="radio" name="sesso" value="m" />M<input type="radio" name="sesso" value="f" checked />F&nbsp;&nbsp;&nbsp;&nbsp; Deceduta: 
<?php
endif;
?>
<input type="checkbox" name="decesso" <?php if ($riga['decesso']==1) echo "checked" ?> value="1" />
</span></div>

<div class="form_riga"><span class="form_sn">Codice fiscale: </span><input class="form_dx" type="text" name="cfnew" value="<?=$riga['cf']?>" /></div>

<div class="form_riga"><span class="form_sn">Codice esenzione: </span><input class="form_dx" type="text" name="asl" value="<?=$riga['asl']?>"/></div>

<div class="form_riga"><span class="form_sn">Numeri di telefono: </span><input class="form_dx" type="text" name="telefoni" value="<?=$riga['telefoni']?>"/></div>

<div class="form_riga"><span class="form_sn">Indirizzo email: </span><input class="form_dx" type="text" name="email" value="<?=$riga['email']?>"/></div>

<div class="form_riga"><span class="form_sn">Domicilio (Citt&agrave;, via): </span><input class="form_dx" type="text" name="domicilio" value="<?=$riga['domicilio']?>"/></div>

<div class="form_riga"><span class="form_sn">Professione: </span><input class="form_dx" type="text" name="professione" value="<?=$riga['professione']?>"/></div>

<div class="form_riga"><span class="form_sn">Stato civile: </span><input class="form_dx" type="text" name="statocivile" value="<?=$riga['statocivile']?>"/></div>

<div class="form_riga"><span class="form_sn">Diagnosi sintetica: </span><input class="form_dx" type="text" name="diagnosi" value="<?=$riga['diagnosi']?>"/></div>

<div class="form_riga"><span class="form_sn">Provenienza e note: </span><input class="form_dx" type="text" name="note" value="<?=$riga['note']?>"/></div>

<div class="form_riga"><input class="form_sn" type="submit" name="submit" value="Aggiorna i dati" /></div>

</form>

<?php
//inserisce i link alle anamnesi, mettendole a sfondo rosso se compilate
//Sfruttando la lista delle scale, per ciascuna viene verificata la presenza
//di una scala compilata per quell'id, altrimenti si crea nuova

echo "<div class=\"barranamnesi\">";

foreach($listanamnesi as $analink => $anadesc) {

    $qanamnesi="SELECT * FROM $analink WHERE idpz='$idpz'";
    if (!$result_qanamnesi = $mysqli->query($qanamnesi)) echo "Query error";
    $anamnesipresente=mysqli_num_rows($result_qanamnesi);

    echo "<span ";
    if ($anamnesipresente==1) echo "class=\"siscala\"";
    echo "><a href=javascript:popUp('$analink.php?idpz=$idpz&medico=$medico')>";
    echo $anadesc;
    echo "</a></span>  ";

}

echo "</div>";


//Se sono presenti gia' visite le visualizza, altrimenti permette solo di inserire la prima visita
$query_visite = ("SELECT * FROM visite WHERE idpz='$idpz' ");
if (!$result_visite = $mysqli->query($query_visite)) echo "Query error";

	if ($result_visite) {
		while ($rigav = mysqli_fetch_assoc($result_visite)) {
		
		$datavisita = date('r',$rigav['data']); //Converti da timestamp a data visita
		
		extract ($rigav); //converti l'array della riga in singole variabili

		$etichettadata = date("d-m-y",$rigav['data']);

        //inserisce i link alle scale, mettendole a sfondo rosso se compilate
        //poiché la visita non ha ancora un id prima di essere inserita
        //e la scala sfrutta l'id_visita della visita, le scale possono essere
        //compilate solo per le visite già inserite
        $idvisita = $rigav['id_visita'];

		$idlabel = "label".$idvisita; //crea un id per ogni etichetta di ciascuna visita in modo da lavorarci con JS

        //Sfruttando la lista delle scale, per ciascuna viene verificata la presenza
        //di una scala compilata per quell'id, altrimenti si crea nuova

        $qlistascale = "SELECT * FROM listascale";
        if (!$result_qlistascale = $mysqli->query($qlistascale)) echo "Query error";

	//stabilisci sfondo verde per contatti telefonici/mail
	if (mb_eregi('tele',$luogo)) $colore_etichetta="white";
	else $colore_etichetta="yellow";

	echo "<div id=\"$idlabel\" onclick=\"if(document.getElementById('$idvisita').style.display=='none') {document.getElementById('$idvisita').style.display='block'; document.getElementById('$idlabel').style.paddingBottom='1em'; document.getElementById('$idlabel').style.marginBottom='0em';} else {document.getElementById('$idvisita').style.display='none'; document.getElementById('$idlabel').style.paddingBottom='0em'; document.getElementById('$idlabel').style.marginBottom='1em';}\" style=\"color: black; cursor: pointer; background-color: $colore_etichetta; margin: 1em 1em 1em 1em; float: left\">$etichettadata</div>";

	echo "<div class=\"vecchievisite\" id=\"$idvisita\" style=\"display: none\">";

	echo "<div style=\"background-color: $colore_etichetta\" class=\"scala\">";

        foreach ($listascale as $scalalink => $scaladesc) {

            $qscala = "SELECT * FROM $scalalink WHERE id_visita='$idvisita'";
            if (!$result_qscala = $mysqli->query($qscala)) echo "Query error";
            $scalapresente = mysqli_num_rows($result_qscala);
            
            echo "<span ";
            if ($scalapresente==1) echo "class=\"siscala\"";
            echo "><a href=javascript:popUp('jscript.php?scala=$scalalink&id=$idvisita&idpz=$idpz')>";
            echo $scaladesc;
            echo "</a></span>  ";

        }

        echo "</div>";
        
		//modifica visita corrente
		echo "<div style=\"float: right; border: white solid 2px; color: white\"><a href=javascript:popUp('editavisita.php?idvisita=$idvisita&ts=$ts')>modifica</a></div>";
		
        scrivi ("<span style=\"font-weight: bold\">Visita del:</span> $datavisita","data");
        //scrivi("<span style=\"font-weight: bold\">Medico:</span> $medico","medico");
        scrivi ("<span style=\"font-weight: bold\">Luogo della visita:</span> $luogo","luogo");
        scrivi ("<span style=\"font-weight: bold\">Terapia in atto:</span> $terapia_atto","terapia");
        $diario = nl2br($diario); //rispetta gli a capo nel diario
        scrivi ("<span style=\"font-weight: bold\">Diario:</span> $diario","diario");
        scrivi ("<span style=\"font-weight: bold\">Esame obiettivo:</span> $eon","eon");
        scrivi ("<span style=\"font-weight: bold\">Terapia prescritta:</span> $terapia_data","terapia");

		echo "</div>";
		
		//memorizza l'ultima terapia per il default della nuova visita
		$terapia_prec = $terapia_data;
		
		}
	}


//form nuova visita
?>

<form class="visita" action="handle_nuova_visita.php" method="post">

<input type="hidden" name="idpz" value="<?=$idpz?>" />
<input type="hidden" name="ts" value="<?=$ts?>" />
<input type="hidden" name="medico" value="<?=$medico?>" />

<div class="form_riga"><span class="form_sn">Luogo della visita:</span>
<select name="luogo">

<?php
array_walk ($lista_luoghi, luogo_option);
?>

</select>
</div>

<div class="form_riga"><span class="form_sn">Terapia in atto:</span><textarea class="textarea_dx" style="height: 4em" name="terapia_atto"><?=$terapia_prec?></textarea></div>
<div class="form_riga"><span class="form_sn">Diario:</span><textarea class="textarea_dx" style="height: 14em" name="diario"></textarea></div>
<div class="form_riga"><span class="form_sn">Esame neurologico:</span><textarea class="textarea_dx" style="height: 10em" name="eon"></textarea></div>
<div class="form_riga"><span class="form_sn">Terapia prescritta:</span><textarea class="textarea_dx" style="height: 4em" name="terapia_data"><?=$terapia_prec?></textarea></div>

<div><input style="font-size: 1em" type="submit" name="submit" value="Aggiungi visita" /></div>
</form>

<?php
else:
?>

<form action="handle_nuovo_pz.php" method="post">

<input type="hidden" name="ts" value="<?=$ts?>" />
<input type="hidden" name="medico" value="<?=$medico?>" />

<div class="form_riga"><span class="form_sn">Cognome: </span><input class="form_dx" type="text" name="cognome" required /></div>

<div class="form_riga"><span class="form_sn">Nome: </span><input class="form_dx" type="text" name="nome" required /></div>

<div class="form_riga"><span class="form_sn">Data di nascita (gg-mm-aaaa): </span><input class="form_dx" type="text" name="nascita_data" pattern="\d{2}-\d{2}-\d{4}" required /></div>

<div class="form_riga"><span class="form_sn">Comune di nascita: </span><input class="form_dx" type="text" name="nascita_luogo" required /></div>

<div class="form_riga"><span class="form_sn">Sesso: </span><input type="radio" name="sesso" value="m" />M<input type="radio" name="sesso" value="f" />F</div>

<div class="form_riga"><span class="form_sn">Codice esenzione: </span><input class="form_dx" type="text" name="asl" /></div>

<div class="form_riga"><span class="form_sn">Numeri di telefono: </span><input class="form_dx" type="text" name="telefoni" /></div>

<div class="form_riga"><span class="form_sn">Indirizzo email: </span><input class="form_dx" type="email" name="email" /></div>

<div class="form_riga"><span class="form_sn">Domicilio (Citt&agrave;, via): </span><input class="form_dx" type="text" name="domicilio" /></div>

<div class="form_riga"><span class="form_sn">Professione: </span><input class="form_dx" type="text" name="professione" /></div>

<div class="form_riga"><span class="form_sn">Stato civile: </span><input class="form_dx" type="text" name="statocivile" /></div>

<div class="form_riga"><span class="form_sn">Diagnosi sintetica: </span><input class="form_dx" type="text" name="diagnosi" /></div>

<div class="form_riga"><span class="form_sn">Provenienza e note: </span><input class="form_dx" type="text" name="note" /></div>

<div class="form_riga"><span class="form_sn"><input style="font-size: 1em" type="submit" name="submit" value="Aggiungi paziente" /></span></div>

</form>

<?php
endif;
?>

</body>
</html>
