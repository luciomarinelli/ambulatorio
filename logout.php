
<?php

require("testa.php");

$ts=$_GET[ts];

$medico=medico($ts);

$tsquery="UPDATE medici SET cod_ts='0' WHERE cod_ts=$ts";
$tsresult=mysql_query ($tsquery);

if ($tsresult) {
	scrivi ("Sessione terminata correttamente","corretto");
	logga ($medico,"logout");
	}
else scrivi ("Attenzione! Sessione non terminata correttamente!","errore");

mysql_close($conn);

//Esegui il backup del database con phpmysqlautobackup
if ($_GET[backup]=="si") include ("phpmysqlautobackup/run.php");

?>

<div class="comando"><a href="index.php">Clicca qui per iniziare una nuova sessione</a></div>

</body>
</html>
