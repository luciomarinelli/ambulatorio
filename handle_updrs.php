<html>
<head>
<meta name="author" content="Lucio Marinelli" />
<meta name="generator" content="Gedit" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" media="all" href="ambulatorio_all.css">
<link rel="stylesheet" type="text/css" media="handheld, only screen and (max-width: 640px)" href="ambulatorio_mobile.css">
</head>

<body>

<?php

require ("config.inc.php");
require ("dbconnect.inc.php");
require ("funzioni.inc.php");

extract($_POST);

if ($opera=="insert") {
    $query = ("INSERT IGNORE INTO updrs (id_visita,onoff,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13,q14,q15,q16,q17,q18,q19,q20t,q20asdx,q20assn,q20aidx,q20aisn,q21dx,q21sn,q22t,q22asdx,q22assn,q22aidx,q22aisn,q23dx,q23sn,q24dx,q24sn,q25dx,q25sn,q26dx,q26sn,q27,q28,q29,q30,q31,q32,q33,q34,q35,q36,q37,q38,q39,q40,q41,q42)	VALUES ('$id','$onoff','$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$q9','$q10','$q11','$q12','$q13','$q14','$q15','$q16','$q17','$q18','$q19','$q20t','$q20asdx','$q20assn','$q20aidx','$q20aisn','$q21dx','$q21sn','$q22t','$q22asdx','$q22assn','$q22aidx','$q22aisn','$q23dx','$q23sn','$q24dx','$q24sn','$q25dx','$q25sn','$q26dx','$q26sn','$q27','$q28','$q29','$q30','$q31','$q32','$q33','$q34','$q35','$q36','$q37','$q38','$q39','$q40','$q41','$q42')");
    if (!$result = $mysqli->query($query)) echo "Query error";
    if ($result == 1) scrivi ("Scala inserita correttamente, chiudere la finestra","corretto");
    else scrivi ("Errore durante l'inserimento della scala!","errore");
    }
else {
    $query = ("UPDATE IGNORE updrs SET onoff='$onoff',q1='$q1',q2='$q2',q3='$q3',q4='$q4',q5='$q5',q6='$q6',q7='$q7',q8='$q8',q9='$q9',q10='$q10',q11='$q11',q12='$q12',q13='$q13',q14='$q14',q15='$q15',q16='$q16',q17='$q17',q18='$q18',q19='$q19',q20t='$q20t',q20asdx='$q20asdx',q20assn='$q20assn',q20aidx='$q20aidx',q20aisn='$q20aisn',q21dx='$q21dx',q21sn='$q21sn',q22t='$q22t',q22asdx='$q22asdx',q22assn='$q22assn',q22aidx='$q22aidx',q22aisn='$q22aisn',q23dx='$q23dx',q23sn='$q23sn',q24dx='$q24dx',q24sn='$q24sn',q25dx='$q25dx',q25sn='$q25sn',q26dx='$q26dx',q26sn='$q26sn',q27='$q27',q28='$q28',q29='$q29',q30='$q30',q31='$q31',q32='$q32',q33='$q33',q34='$q34',q35='$q35',q36='$q36',q37='$q37',q38='$q38',q39='$q39',q40='$q40',q41='$q41',q42='$q42' WHERE id_visita='$id' ");
    if (!$result = $mysqli->query($query)) echo "Query error";
    if ($result == 1) scrivi ("Scala aggiornata correttamente, chiudere la finestra","corretto");
    else scrivi ("Errore durante l'aggiornamento della scala!","errore");
    }

?>

</body>
</html>

