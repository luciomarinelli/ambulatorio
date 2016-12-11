<?php

//scala MMSE

$qscala="SELECT * FROM mmse WHERE id_visita='$id'";
$result_qscala = mysql_query ($qscala) or die (mysql_error());
$scalapresente=mysql_num_rows($result_qscala);

if ($scalapresente==1) {
	$opera="update";

	$scala=mysql_fetch_assoc($result_qscala);
	extract($scala);

	//calcola totale
	$totale=$anno+$stagione+$mese+$gmese+$gsett+$stato+$regione+$citta+$luogo+$piano+$capaga+$calcolo+$richiamo+$oggetti+$ripeti+$compito+$occhichiusi+$frase+$disegno;

	echo "<div>Totale (senza correzione): $totale</div>";
}

else $opera="insert";

?>

<form action="handle_mmse.php" method=post>

<input type=hidden name="id" value="<?=$id?>" />
<input type=hidden name="opera" value="<?=$opera?>" />


<ul>

<li>Il paziente sa riferire l'anno
<?php if (!isset($anno)) $anno=-1;  ?>
<div>
<input type="radio" name="anno" value="1" <?php if($anno==1) echo "checked"; ?> />Corretto
<input type="radio" name="anno" value="0" <?php if($anno==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Il paziente sa riferire la stagione
<?php if (!isset($stagione)) $stagione=-1;  ?>
<div>
<input type="radio" name="stagione" value="1" <?php if($stagione==1) echo "checked"; ?> />Corretto
<input type="radio" name="stagione" value="0" <?php if($stagione==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Il paziente sa riferire il mese
<?php if (!isset($mese)) $mese=-1;  ?>
<div>
<input type="radio" name="mese" value="1" <?php if($mese==1) echo "checked"; ?> />Corretto
<input type="radio" name="mese" value="0" <?php if($mese==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Il paziente sa riferire il giorno del mese
<?php if (!isset($gmese)) $gmese=-1;  ?>
<div>
<input type="radio" name="gmese" value="1" <?php if($gmese==1) echo "checked"; ?> />Corretto
<input type="radio" name="gmese" value="0" <?php if($gmese==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Il paziente sa riferire il giorno della settimana
<?php if (!isset($gsett)) $gsett=-1;  ?>
<div>
<input type="radio" name="gsett" value="1" <?php if($gsett==1) echo "checked"; ?> />Corretto
<input type="radio" name="gsett" value="0" <?php if($gsett==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Il paziente sa riferire in che stato siamo
<?php if (!isset($stato)) $stato=-1;  ?>
<div>
<input type="radio" name="stato" value="1" <?php if($stato==1) echo "checked"; ?> />Corretto
<input type="radio" name="stato" value="0" <?php if($stato==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Il paziente sa riferire in che regione siamo
<?php if (!isset($regione)) $regione=-1;  ?>
<div>
<input type="radio" name="regione" value="1" <?php if($regione==1) echo "checked"; ?> />Corretto
<input type="radio" name="regione" value="0" <?php if($regione==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Il paziente sa riferire in che citt&agrave; siamo
<?php if (!isset($citta)) $citta=-1;  ?>
<div>
<input type="radio" name="citta" value="1" <?php if($citta==1) echo "checked"; ?> />Corretto
<input type="radio" name="citta" value="0" <?php if($citta==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Il paziente sa riferire in che luogo ci troviamo
<?php if (!isset($luogo)) $luogo=-1;  ?>
<div>
<input type="radio" name="luogo" value="1" <?php if($luogo==1) echo "checked"; ?> />Corretto
<input type="radio" name="luogo" value="0" <?php if($luogo==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Il paziente sa riferire a che piano ci troviamo
<?php if (!isset($piano)) $piano=-1;  ?>
<div>
<input type="radio" name="piano" value="1" <?php if($piano==1) echo "checked"; ?> />Corretto
<input type="radio" name="piano" value="0" <?php if($piano==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Pronunciare ad alta voce usa sola volta il nome di tre oggetti (CASA, GATTO, PANE) al ritmo di uno al secondo e chiedere al paziente di ripeterli. Segnare quanti oggetti ha ripetuto correttamente
<?php if (!isset($capaga)) $capaga=-1;  ?>
<div>
<input type="radio" name="capaga" value="3" <?php if($capaga==3) echo "checked"; ?> />3
<input type="radio" name="capaga" value="2" <?php if($capaga==2) echo "checked"; ?> />2
<input type="radio" name="capaga" value="1" <?php if($capaga==1) echo "checked"; ?> />1
<input type="radio" name="capaga" value="0" <?php if($capaga==0) echo "checked"; ?> />Nessuno
</div>
</li>

<li>Se il paziente non &egrave; stato in grado di ripetere correttamente tutti e 3 gli oggetti, fargieli ripetere finch&eacute; non impara e segnare sotto il numero di ripetizioni
<?php if (!isset($luogo)) $luogo=-1;  ?>
<div>
<input type="number" name="tentativi" size="2,1" value="<?=$tentativi?>" />
</div>
</li>

<li>Far sottrarre serialmente al paziente 7 da 100 (93; 86; 79; 72; 65) e fermarsi dopo 5 risposte.Se il paziente avesse difficoltà di calcolo, far scandire lettera per lettera la parola MONDO all'indietro (ODNOM). Segnare il miglior numero di risposte corrette tra i due esercizi
<?php if (!isset($calcolo)) $calcolo=-1;  ?>
<div>
<input type="radio" name="calcolo" value="5" <?php if($calcolo==5) echo "checked"; ?> />5
<input type="radio" name="calcolo" value="4" <?php if($calcolo==4) echo "checked"; ?> />4
<input type="radio" name="calcolo" value="3" <?php if($calcolo==3) echo "checked"; ?> />3
<input type="radio" name="calcolo" value="2" <?php if($calcolo==2) echo "checked"; ?> />2
<input type="radio" name="calcolo" value="1" <?php if($calcolo==1) echo "checked"; ?> />1
<input type="radio" name="calcolo" value="0" <?php if($calcolo==0) echo "checked"; ?> />Nessuno
</div>
</li>

<li>Chiedere al paziente di ripetere i tre oggetti precedentemente imparati (CASA, GATTO, PANE). Segnare quanti oggetti ha ricordato
<?php if (!isset($richiamo)) $richiamo=-1;  ?>
<div>
<input type="radio" name="richiamo" value="3" <?php if($richiamo==3) echo "checked"; ?> />3
<input type="radio" name="richiamo" value="2" <?php if($richiamo==2) echo "checked"; ?> />2
<input type="radio" name="richiamo" value="1" <?php if($richiamo==1) echo "checked"; ?> />1
<input type="radio" name="richiamo" value="0" <?php if($richiamo==0) echo "checked"; ?> />Nessuno
</div>
</li>

<li>chiedere al paziente &quot;Come si chiama questo?&quot; indicando una matita e un orologio. Segnare il numero di oggetti correttamente nominati
<?php if (!isset($oggetti)) $oggetti=-1;  ?>
<div>
<input type="radio" name="oggetti" value="2" <?php if($oggetti==2) echo "checked"; ?> />2
<input type="radio" name="oggetti" value="1" <?php if($oggetti==1) echo "checked"; ?> />1
<input type="radio" name="oggetti" value="0" <?php if($oggetti==0) echo "checked"; ?> />Nessuno
</div>
</li>

<li>Chiedere al paziente di ripetere la frase &quot;Non c'&egrave; n&eacute; se n&eacute; ma che tenga&quot;
<?php if (!isset($ripeti)) $ripeti=-1;  ?>
<div>
<input type="radio" name="ripeti" value="1" <?php if($ripeti==1) echo "checked"; ?> />Corretto
<input type="radio" name="ripeti" value="0" <?php if($ripeti==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Consegnare al paziente un foglio ed impartire i seguenti comandi:
<ol>
<li>Con la mano destra prenda questo foglio</li>
<li>Lo pieghi a met&agrave;</li>
<li>Lo appoggi sulle ginocchia</li>
</ol>
segnare il numero di operazioni correttamente eseguite
<?php if (!isset($compito)) $compito=-1;  ?>
<div>
<input type="radio" name="compito" value="3" <?php if($compito==3) echo "checked"; ?> />3
<input type="radio" name="compito" value="2" <?php if($compito==2) echo "checked"; ?> />2
<input type="radio" name="compito" value="1" <?php if($compito==1) echo "checked"; ?> />1
<input type="radio" name="compito" value="0" <?php if($compito==0) echo "checked"; ?> />Nessuna
</div>
</li>

<li>Mostrare al paziente un foglio con la scritta &quot;CHIUDA GLI OCCHI&quot; e verificare se il paziente esegue l'ordine
<?php if (!isset($occhichiusi)) $occhichiusi=-1;  ?>
<div>
<input type="radio" name="occhichiusi" value="1" <?php if($occhichiusi==1) echo "checked"; ?> />Corretto
<input type="radio" name="occhichiusi" value="0" <?php if($occhichiusi==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Chiedere al paziente di scrivere una frase costituita almeno da soggetto e verbo
<?php if (!isset($frase)) $frase=-1;  ?>
<div>
<input type="radio" name="frase" value="1" <?php if($frase==1) echo "checked"; ?> />Corretto
<input type="radio" name="frase" value="0" <?php if($frase==0) echo "checked"; ?> />Errato
</div>
</li>

<li>Chiedere al paziente di copiare il disegno standard (due pentagoni intrecciati)
<?php if (!isset($disegno)) $disegno=-1;  ?>
<div>
<input type="radio" name="disegno" value="1" <?php if($disegno==1) echo "checked"; ?> />Corretto
<input type="radio" name="disegno" value="0" <?php if($disegno==0) echo "checked"; ?> />Errato
</div>
</li>

</ul>


<input type="submit" name="submit" value="

<?php
if ($opera=="insert") echo "Aggiungi scala";
else echo "Modifica scala";
?>

" />

</form>

