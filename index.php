
<?php

require("testa.php");

if(!get_magic_quotes_gpc())
	{
		$_POST['cognome'] = addslashes($_POST['cognome']);	// sicurezza
	}


	if (isset($_POST['submit']))
	{	
		$check = "SELECT cognome, password, cod_ts FROM medici WHERE cognome = '".$_POST['cognome']."'";
        if (!$result = $mysqli->query($check)) echo "Query error";
		$num_rows = mysqli_num_rows($result);
	
		if (!($num_rows))		
		{
			die('Utente non riconosciuto');
		}

		$info = mysqli_fetch_Array($result);
	
		// controlla password

		if ($_POST['password'] != $info['password'])
		{
			die('Password sbagliata, riprovare');
		}

		$ts = time();

        if (!$update_login = $mysqli->query("UPDATE medici SET cod_ts = '$ts' WHERE cognome = '".$_POST['cognome']."'")) echo "Query error";

		//log
		logga ($_POST['cognome'],"login"); 
?>

		<div class="corretto">Utente autenticato: <?=$_POST['cognome']?></div> 
		<div class="comando"><a href="anagrafica.php?ts=<?=$ts?>">Clicca qui per procedere</a></div>
		
<?php

	}
	else
	{	// mostra form se questo non è stato inviato

?>
		<form action="index.php" method="post">
		<div class="login">
		<div style="text-align: right">Utente: <input style="font-size: 1em" type="text" name="cognome" maxlength="20" required /></div>
		<div style="text-align: right; margin-top: 1em">Password: <input style="font-size: 1em" type="password" name="password" maxlength="20" required /></div>
		<div style="text-align: right; margin-top: 1em"><input style="font-size: 1em" type="submit" name="submit" value="Entra"></div>
		</div>
		</form>

<?php
	}
?>

</body>
</html>
