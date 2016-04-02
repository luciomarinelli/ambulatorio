<?php

//scala UPDRS

$qscala="SELECT * FROM updrs WHERE id_visita='$id'";
$result_qscala = mysql_query ($qscala) or die (mysql_error());
$scalapresente=mysql_num_rows($result_qscala);
if ($scalapresente==1) {
	$opera="update";

	$scala=mysql_fetch_assoc($result_qscala);
	extract($scala); //produce le variabili $q1, $q2, ecc

	//calcola subtotali e totale
	$sez1=$q1+$q2+$q3+$q4;
	$sez2=$q5+$q6+$q7+$q8+$q9+$q10+$q11+$q12+$q13+$q14+$q15+$q16+$q17;
	$sez3=$q18+$q19+$q20t+$q20asdx+$q20assn+$q20aidx+$q20aisn+$q21dx+$q21sn+$q22t+$q22asdx+$q22assn+$q22aidx+$q22aisn+$q23dx+$q23sn+$q24dx+$q24sn+$q25dx+$q25sn+$q26dx+$q26sn+$q27+$q28+$q29+$q30+$q31;
	$sez4=$q32+$q33+$q34+$q35+$q36+$q37+$q38+$q39+$q40+$q41+$q42;
	$totale=$sez1+$sez2+$sez3+$sez4;

	?>

	<table align="right" border=2>
	<tr><td>Sezione 1</td><td><?=$sez1 ?></td></tr>
	<tr><td>Sezione 2</td><td><?=$sez2 ?></td></tr>
	<tr><td>Sezione 3</td><td><?=$sez3 ?></td></tr>
	<tr><td>Sezione 4</td><td><?=$sez4 ?></td></tr>
	<tr><td>Totale</td><td><?=$totale ?></td></tr>
	</table>

	<?php

}

else {
	$qprecedente="SELECT * FROM updrs WHERE id_visita=(SELECT max(visite.id_visita) FROM updrs LEFT JOIN visite ON updrs.id_visita = visite.id_visita WHERE idpz='$idpz' GROUP BY idpz)"; //solo a partire da versione 4.1 di MySQL
	$rqprecedente= mysql_query ($qprecedente) or die (mysql_error());
	if ($precedente=mysql_fetch_assoc($rqprecedente)) {
		extract($precedente);
		echo "Scala precompilata con i valori dell'ultima visita";
	}
	else echo "Non trovate scale compilate precedentemente per questo paziente";
    
    $opera="insert";
}


//carica gli array con la descrizione degli items
$aq1=array('None.',
'Mild. Consistent forgetfulness with partial recollection of events and no other difficulties.',
'Moderate memory loss, with disorientation and moderate difficulty handling complex problems. Mild but definite impairment of function at home with need of occasional prompting.',
'Severe memory loss with disorientation for time and often to place. Severe impairment in handling problems.',
'Severe memory loss with orientation preserved to person only. Unable to make judgements or solve problems. Requires much help with personal care. Cannot be left alone at all.');

$aq2=array('None.',
'Vivid dreaming.',
'"Benign" hallucinations with insight retained.',
'Occasional to frequent hallucinations or delusions; without insight; could interfere with daily activities.',
'Persistent hallucinations, delusions, or florrid psychosis. Not able to care for self.');

$aq3=array('None.',
'Periods of sadness or guilt greater than normal, never sustained for days or weeks.',
'Sustained depression (1 week or more).',
'Sustained depression with vegetative symptoms (insomnia, anorexia, weight loss, loss of interest).',
'Sustained depression with vegetative symptoms and suicidal thoughts or intent.');

$aq4=array('Normal.',
'Less assertive than usual; more passive.',
'Loss of initiative or disinterest in elective (nonroutine) activities.',
'Loss of initiative or disinterest in day to day (routine) activities.',
'Withdrawn, complete loss of motivation.');

$aq5=array('Normal.',
'Mildly affected. No difficulty being understood.',
'Moderately affected. Sometimes asked to repeat statements.',
'Severely affected. Frequently asked to repeat statements.',
'Unintelligible most of the time.');

$aq6=array('Normal.',
'Slight but definite excess of saliva in mouth; may have nighttime drooling.',
'Moderately excessive saliva; may have minimal drooling.',
'Marked excess of saliva with some drooling.',
'Marked drooling, requires constant tissue or handkerchief.');

$aq7=array('Normal.',
'Rare choking.',
'Occasional choking.',
'Requires soft food.',
'Requires NG tube or gastrotomy feeding.');

$aq8=array('Normal.',
'Slightly slow or small.',
'Moderately slow or small; all words are legible.',
'Severely affected; not all words are legible.',
'The majority of words are not legible.');

$aq9=array('Normal.',
'Somewhat slow and clumsy, but no help needed.',
'Can cut most foods, although clumsy and slow; some help needed.',
'Food must be cut by someone, but can still feed slowly.',
'Needs to be fed.');

$aq10=array('Normal.',
'Somewhat slow, but no help needed.',
'Occasional assistance with buttoning, getting arms in sleeves.',
'Considerable help required, but can do some things alone.',
'Helpless.');

$aq11=array('Normal.',
'Somewhat slow, but no help needed.',
'Needs help to shower or bathe; or very slow in hygienic care.',
'Requires assistance for washing, brushing teeth, combing hair, going to bathroom.',
'Foley catheter or other mechanical aids.');

$aq12=array('Normal.',
'Somewhat slow and clumsy, but no help needed.',
'Can turn alone or adjust sheets, but with great difficulty.',
'Can initiate, but not turn or adjust sheets alone.',
'Helpless.');

$aq13=array('None.',
'Rare falling.',
'Occasionally falls, less than once per day.',
'Falls an average of once daily.',
'Falls more than once daily.');

$aq14=array('None.',
'Rare freezing when walking; may have starthesitation.',
'Occasional freezing when walking.',
'Frequent freezing. Occasionally falls from freezing.',
'Frequent falls from freezing.');

$aq15=array('Normal.',
'Mild difficulty. May not swing arms or may tend to drag leg.',
'Moderate difficulty, but requires little or no assistance.',
'Severe disturbance of walking, requiring assistance.',
'Cannot walk at all, even with assistance.');

$aq16=array('Absent.',
'Slight and infrequently present.',
'Moderate; bothersome to patient.',
'Severe; interferes with many activities.',
'Marked; interferes with most activities.');

$aq17=array('None.',
'Occasionally has numbness, tingling, or mild aching.',
'Frequently has numbness, tingling, or aching; not distressing.',
'Frequent painful sensations.',
'Excruciating pain.');

$aq18=array('Normal.',
'Slight loss of expression, diction and/or volume.',
'Monotone, slurred but understandable; moderately impaired.',
'Marked impairment, difficult to understand.',
'Unintelligible.');

$aq19=array('Normal.',
'Minimal hypomimia, could be normal "Poker Face".',
'Slight but definitely abnormal diminution of facial expression',
'Moderate hypomimia; lips parted some of the time.',
'Masked or fixed facies with severe or complete loss of facial expression; lips parted 1/4 inch or more.');

$aq20=array('Absent.',
'Slight and infrequently present.',
'Mild in amplitude and persistent. Or moderate in amplitude, but only intermittently present.',
'Moderate in amplitude and present most of the time.',
'Marked in amplitude and present most of the time.');

$aq21=array('Absent.',
'Slight; present with action.',
'Moderate in amplitude, present with action.',
'Moderate in amplitude with posture holding as well as action.',
'Marked in amplitude; interferes with feeding.');

$aq22=array('Absent.',
'Slight or detectable only when activated by mirror or other movements.',
'Mild to moderate.',
'Marked, but full range of motion easily achieved.',
'Severe, range of motion achieved with difficulty.');

$aq23=array('Normal.',
'Mild slowing and/or reduction in amplitude.',
'Moderately impaired. Definite and early fatiguing. May have occasional arrests in movement.',
'Severely impaired. Frequent hesitation in initiating movements or arrests in ongoing movement.',
'Can barely perform the task.');

$aq24=array('Normal.',
'Mild slowing and/or reduction in amplitude.',
'Moderately impaired. Definite and early fatiguing. May have occasional arrests in movement.',
'Severely impaired. Frequent hesitation in initiating movements or arrests in ongoing movement.',
'Can barely perform the task.');

$aq27=array('Normal.',
'Slow; or may need more than one attempt.',
'Pushes self up from arms of seat.',
'Tends to fall back and may have to try more than one time, but can get up without help.',
'Unable to arise without help.');

$aq28=array('Normal erect.',
'Not quite erect, slightly stooped posture; could be normal for older person.',
'Moderately stooped posture, definitely abnormal; can be slightly leaning to one side.',
'Severely stooped posture with kyphosis; can be moderately leaning to one side.',
'Marked flexion with extreme abnormality of posture.');

$aq29=array('Normal.',
'Walks slowly, may shuffle with short steps, but no festination (hastening steps) or propulsion.',
'Walks with difficulty, but requires little or no assistance; may have some festination, short steps, or propulsion.',
'Severe disturbance of gait, requiring assistance.',
'Cannot walk at all, even with assistance.');

$aq30=array('Normal.',
'Retropulsion, but recovers unaided.',
'Absence of postural response; would fall if not caught by examiner.',
'Very unstable, tends to lose balance spontaneously.',
'Unable to stand without assistance.');

$aq31=array('None.',
'Minimal slowness, giving movement a deliberate character; could be normal for some persons. Possibly reduced amplitude.',
'Mild degree of slowness and poverty of movement which is definitely abnormal. Alternatively, some reduced amplitude.',
'Moderate slowness, poverty or small amplitude of movement.',
'Marked slowness, poverty or small amplitude of movement.');

$aq32=array('None',
'1-25% of day.',
'26-50% of day.',
'51-75% of day.',
'76-100% of day.');

$aq33=array('Not disabling.',
'Mildly disabling.',
'Moderately disabling.',
'Severely disabling.',
'Completely disabled.');

$aq34=array('No painful dyskinesias.',
'Slight.',
'Moderate.',
'Severe.',
'Marked.');

$aq35=array('No',
'Yes');

$aq39=array('None',
'1-25% of day.',
'26-50% of day.',
'51-75% of day.',
'76-100% of day.');





?>

<form action="handle_updrs.php" method=post>

<input type=hidden name="id" value="<?=$id?>" />
<input type=hidden name="opera" value="<?=$opera?>" />


<div>
Condizione del paziente al momento della visita:
 <input type="radio" name="onoff" value="0"
<?php if(isset($onoff) && $onoff==0) echo "checked"; ?>
  />OFF
 <input type="radio" name="onoff" value="1"
<?php if($onoff==1) echo "checked" ?>
  />ON
</div>

<ol>

<div class="classiupdrs">I. MENTATION, BEHAVIOR AND MOOD</div>

<li>Intellectual impairment:
<?php
if (!isset($q1)) $q1=-1; //evita che valore assente venga interpretato come 0
listitem($aq1,"q1",$q1);
 ?>
</li>


<li>Thought Disorder (Due to dementia or drug intoxication):
<?php
if (!isset($q2)) $q2=-1;
listitem($aq2,"q2",$q2);
 ?>
</li>


<li>Depression:
<?php
if (!isset($q3)) $q3=-1;
listitem($aq3,"q3",$q3);
 ?>
</li>


<li>Motivation/Initiative:
<?php
if (!isset($q4)) $q4=-1;
listitem($aq4,"q4",$q4);
 ?>
</li>


<div class="classiupdrs">II. ACTIVITIES OF DAILY LIVING</div>

<li>Speech:
<?php
if (!isset($q5)) $q5=-1;
listitem($aq5,"q5",$q5);
 ?>
</li>


<li>Salivation:
<?php
if (!isset($q6)) $q6=-1;
listitem($aq6,"q6",$q6);
 ?>
</li>


<li>Swallowing:
<?php
if (!isset($q7)) $q7=-1;
listitem($aq7,"q7",$q7);
 ?>
</li>


<li>Handwriting:
<?php
if (!isset($q8)) $q8=-1;
listitem($aq8,"q8",$q8);
 ?>
</li>


<li>Cutting food and handling utensils:
<?php
if (!isset($q9)) $q9=-1;
listitem($aq9,"q9",$q9);
 ?>
</li>


<li>Dressing:
<?php
if (!isset($q10)) $q10=-1;
listitem($aq10,"q10",$q10);
 ?>
</li>


<li>Hygiene:
<?php
if (!isset($q11)) $q11=-1;
listitem($aq11,"q11",$q11);
 ?>
</li>


<li>Turning in bed and adjusting bed clothes:
<?php
if (!isset($q12)) $q12=-1;
listitem($aq12,"q12",$q12);
 ?>
</li>


<li>Falling (unrelated to freezing):
<?php
if (!isset($q13)) $q13=-1;
listitem($aq13,"q13",$q13);
 ?>
</li>


<li>Freezing when walking:
<?php
if (!isset($q14)) $q14=-1;
listitem($aq14,"q14",$q14);
 ?>
</li>


<li>Walking:
<?php
if (!isset($q15)) $q15=-1;
listitem($aq15,"q15",$q15);
 ?>
</li>


<li>Tremor (Symptomatic complaint of tremor in any part of body.):
<?php
if (!isset($q16)) $q16=-1;
listitem($aq16,"q16",$q16);
 ?>
</li>


<li>Sensory complaints related to parkinsonism:
<?php
if (!isset($q17)) $q17=-1;
listitem($aq17,"q17",$q17);
 ?>
</li>


<div class="classiupdrs">III. MOTOR EXAMINATION</div>

<li>Speech:
<?php
if (!isset($q18)) $q18=-1;
listitem($aq18,"q18",$q18);
 ?>
</li>


<li>Facial Expression:
<?php
if (!isset($q19)) $q19=-1;
listitem($aq19,"q19",$q19);
 ?>
</li>


<li>Tremor at rest:
<ul>
<li>Head:
<?php
if (!isset($q20t)) $q20t=-1;
listitem($aq20,"q20t",$q20t);
 ?>
</li>
<li>Right upper limb:
<?php
if (!isset($q20asdx)) $q20asdx=-1;
listitem($aq20,"q20asdx",$q20asdx);
 ?>
</li>
<li>Left upper limb:
<?php
if (!isset($q20assn)) $q20assn=-1;
listitem($aq20,"q20assn",$q20assn);
 ?>
</li>
<li>Right lower limb:
<?php
if (!isset($q20aidx)) $q20aidx=-1;
listitem($aq20,"q20aidx",$q20aidx);
 ?>
</li>
<li>Left lower limb:
<?php
if (!isset($q20aisn)) $q20aisn=-1;
listitem($aq20,"q20aisn",$q20aisn);
 ?>
</li>
</ul></li>


<li>Action or Postural Tremor of hands:
<ul>
<li>Right:
<?php
if (!isset($q21dx)) $q21dx=-1;
listitem($aq21,"q21dx",$q21dx);
 ?>
</li>
<li>Left:
<?php
if (!isset($q21sn)) $q21sn=-1;
listitem($aq21,"q21sn",$q21sn);
 ?>
</li>
</ul></li>


<li>Rigidity (Judged on passive movement of major joints with patient relaxed in sitting position. Cogwheeling to be ignored.):
<ul>
<li>Head:
<?php
if (!isset($q22t)) $q22t=-1;
listitem($aq22,"q22t",$q22t);
 ?>
</li>
<li>Right upper limb:
<?php
if (!isset($q22asdx)) $q22asdx=-1;
listitem($aq22,"q22asdx",$q22asdx);
 ?>
</li>
<li>Left upper limb:
<?php
if (!isset($q22assn)) $q22assn=-1;
listitem($aq22,"q22assn",$q22assn);
 ?>
</li>
<li>Right lower limb:
<?php
if (!isset($q22aidx)) $q22aidx=-1;
listitem($aq22,"q22aidx",$q22aidx);
 ?>
</li>
<li>Left lower limb:
<?php
if (!isset($q22aisn)) $q22aisn=-1;
listitem($aq22,"q22aisn",$q22aisn);
 ?>
</li>
</ul></li>


<li>Finger taps (Patient taps thumb with index finger in rapid succession.):
<ul>
<li>Right:
<?php
if (!isset($q23dx)) $q23dx=-1;
listitem($aq23,"q23dx",$q23dx);
 ?>
</li>
<li>Left:
<?php
if (!isset($q23sn)) $q23sn=-1;
listitem($aq23,"q23sn",$q23sn);
 ?>
</li>
</ul></li>


<li>Hand Movements (Patient opens and closes hands in rapid succesion.):
<ul>
<li>Right:
<?php
if (!isset($q24dx)) $q24dx=-1;
listitem($aq24,"q24dx",$q24dx);
 ?>
</li>
<li>Left:
<?php
if (!isset($q24sn)) $q24sn=-1;
listitem($aq24,"q24sn",$q24sn);
 ?>
</li>
</ul></li>


<li>Rapid Alternating Movements of Hands (Pronation-supination movements of hands, vertically and horizontally, with as large an amplitude as possible, both hands simultaneously.):
<ul>
<li>Right:
<?php
if (!isset($q25dx)) $q25dx=-1;
listitem($aq24,"q25dx",$q25dx);
 ?>
</li>
<li>Left:
<?php
if (!isset($q25sn)) $q25sn=-1;
listitem($aq24,"q25sn",$q25sn);
 ?>
</li>
</ul></li>


<li>Leg Agility (Patient taps heel on the ground in rapid succession picking up entire leg. Amplitude should be at least 3 inches.):
<ul>
<li>Right:
<?php
if (!isset($q26dx)) $q26dx=-1;
listitem($aq24,"q26dx",$q26dx);
 ?>
</li>
<li>Left:
<?php
if (!isset($q26sn)) $q26sn=-1;
listitem($aq24,"q26sn",$q26sn);
 ?>
</li>
</ul></li>


<li>Arising from Chair (Patient attempts to rise from a straightbacked chair, with arms folded across chest.):
<?php
if (!isset($q27)) $q27=-1;
listitem($aq27,"q27",$q27);
 ?>
</li>


<li>Posture:
<?php
if (!isset($q28)) $q28=-1;
listitem($aq28,"q28",$q28);
 ?>
</li>


<li>Gait:
<?php
if (!isset($q29)) $q29=-1;
listitem($aq29,"q29",$q29);
 ?>
</li>


<li>Postural Stability (Response to sudden, strong posterior displacement produced by pull on shoulders while patient erect with eyes open and feet slightly apart. Patient is prepared.):
<?php
if (!isset($q30)) $q30=-1;
listitem($aq30,"q30",$q30);
 ?>
</li>


<li>Body Bradykinesia and Hypokinesia (Combining slowness, hesitancy, decreased armswing, small amplitude, and poverty of movement in general.):
<?php
if (!isset($q31)) $q31=-1;
listitem($aq31,"q31",$q31);
 ?>
</li>


<div class="classiupdrs">IV. COMPLICATIONS OF THERAPY (In the past week)</div>

<div>A. DYSKINESIAS</div>

<li>Duration: What proportion of the waking day are dyskinesias present? (Historical information.):
<?php
if (!isset($q32)) $q32=-1;
listitem($aq32,"q32",$q32);
 ?>
</li>


<li>Disability: How disabling are the dyskinesias? (Historical information; may be modified by office examination.):
<?php

if (!isset($q33)) $q33=-1;
listitem($aq33,"q33",$q33);
 ?>
</li>


<li>Painful Dyskinesias: How painful are the dyskinesias?:
<?php
if (!isset($q34)) $q34=-1;
listitem($aq34,"q34",$q34);
 ?>
</li>


<li>Presence of Early Morning Dystonia (Historical information.):
<?php
if (!isset($q35)) $q35=-1;
listitem($aq35,"q35",$q35);
 ?>
</li>


<div>B. CLINICAL FLUCTUATIONS</div>

<li>Are "off" periods predictable?:
<?php
if (!isset($q36)) $q36=-1;
listitem($aq35,"q36",$q36);
 ?>
</li>


<li>Are "off" periods unpredictable?:
<?php
if (!isset($q37)) $q37=-1;
listitem($aq35,"q37",$q37);
 ?>
</li>


<li>Do "off" periods come on suddenly, within a few seconds?:
<?php
if (!isset($q38)) $q38=-1;
listitem($aq35,"q38",$q38);
 ?>
</li>


<li>What proportion of the waking day is the patient "off" on average?:
<?php
if (!isset($q39)) $q39=-1;
listitem($aq39,"q39",$q39);
 ?>
</li>


<div>C. OTHER COMPLICATIONS</div>

<li>Does the patient have anorexia, nausea, or vomiting?:
<?php
if (!isset($q40)) $q40=-1;
listitem($aq35,"q40",$q40);
 ?>
</li>


<li>Any sleep disturbances, such as insomnia or hypersomnolence?:
<?php
if (!isset($q41)) $q41=-1;
listitem($aq35,"q41",$q41);
 ?>
</li>


<li>Does the patient have symptomatic orthostasis?:
<?php
if (!isset($q42)) $q42=-1;
listitem($aq35,"q42",$q42);
 ?>
</li>






</ol>


<input type="submit" name="submit" value="

<?php
if ($opera=="insert") echo "Aggiungi scala";
else echo "Modifica scala";
?>

" />

</form>

