<?php

//scala di Hoehn & Yahr

$qscala="SELECT * FROM hy WHERE id_visita='$id'";
if (!$result_qscala = $mysqli->query($qscala)) echo "Query error";
$scalapresente=mysqli_num_rows($result_qscala);
$scala=mysqli_fetch_assoc($result_qscala);
if ($scalapresente==1) {
    $rate=$scala['stage'];
    $opera="update";
  }
else {
	$qprecedente="SELECT * FROM hy WHERE id_visita=(SELECT max(visite.id_visita) FROM hy LEFT JOIN visite ON hy.id_visita = visite.id_visita WHERE idpz='$idpz' GROUP BY idpz)"; //solo a partire da versione 4.1 di MySQL
    if (!$rqprecedente= $mysqli->query($qprecedente)) echo "Query error";
	if ($precedente=mysqli_fetch_assoc($rqprecedente)) {
		$rate=$precedente['stage'];
		echo "Scala precompilata con i valori dell'ultima visita";
	}
	else echo "Non trovate scale compilate precedentemente per questo paziente";
    
	$opera="insert";
	}

?>

<form action="handle_hy.php" method="post">

<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="opera" value="<?=$opera?>" />

<input type="radio" name="rate" value="0" <?php if($rate=='0') echo "checked"; ?> />STAGE 0 = No signs of disease.<br />
<input type="radio" name="rate" value="1" <?php if($rate=='1') echo "checked"; ?> />STAGE 1 = Unilateral disease.<br />
<input type="radio" name="rate" value="1.5" <?php if($rate=='1.5') echo "checked"; ?> />STAGE 1.5 = Unilateral plus axial involvement.<br />
<input type="radio" name="rate" value="2" <?php if($rate=='2') echo "checked"; ?> />STAGE 2 = Bilateral disease, without impairment of balance.<br />
<input type="radio" name="rate" value="2.5" <?php if($rate=='2.5') echo "checked"; ?> />STAGE 2.5 = Mild bilateral disease, with recovery on pull test.<br />
<input type="radio" name="rate" value="3" <?php if($rate=='3') echo "checked"; ?> />STAGE 3 = Mild to moderate bilateral disease; some postural instability; physically independent.<br />
<input type="radio" name="rate" value="4" <?php if($rate=='4') echo "checked"; ?> />STAGE 4 = Severe disability; still able to walk or stand unassisted.<br />
<input type="radio" name="rate" value="5" <?php if($rate=='5') echo "checked"; ?> />STAGE 5 = Wheelchair bound or bedridden unless aided.<br />

<input type="submit" name="submit" value="

<?php
if ($opera=="insert") echo "Aggiungi scala";
else echo "Modifica scala";
?>

" />

</form>

<ol style="font-size: 10px; line-height: 1em; margin: opx 0px 0px 0px">
<li>Stage One</li>
<ul>
<li>Signs and symptoms on one side only</li>
<li>Symptoms mild</li>
<li>Symptoms inconvenient but not disabling</li>
<li>Usually presents with tremor of one limb</li>
<li>Friends have noticed changes in posture, locomotion and facial expression</li>
</ul>
<li>Stage Two</li>
<ul>
<li>Symptoms are bilateral</li>
<li>Minimal disability</li>
<li>Posture and gait affected</li>
</ul>
<li>Stage Three</li>
<ul>
<li>Significant slowing of body movements</li>
<li>Early impairment of equilibrium on walking or standing</li>
<li>Generalized dysfunction that is moderately severe</li>
</ul>
<li>Stage Four</li>
<ul>
<li>Severe symptoms</li>
<li>Can still walk to a limited extent</li>
<li>Rigidity and bradykinesia</li>
<li>No longer able to live alone</li>
<li>Tremor may be less than earlier stages</li>
</ul>
<li>Stage Five</li>
<ul>
<li>Cachectic stage</li>
<li>Invalidism complete</li>
<li>Cannot stand or walk</li>
<li>Requires constant nursing care</li>
</ul>
</ol>
