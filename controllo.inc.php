<?php

//nella pagina di ricerca il ts non è trasmesso tramite GET ma tramite POST
if (isset($_POST['ts'])) $_GET['ts']=$_POST['ts'];

//controllo autenticazione

if (!isset($_GET['ts']) || $_GET['ts']==0)  {
	scrivi('Accesso non autorizzato','errore');
	exit();
	}
$ts=$_GET['ts'];
$medico=medico($ts);

if($medico!=NULL) {
//Scrivere qui cosa fare se autenticato

?>

<div class="barra_utente">Utente: <strong><?=$medico ?></strong>, versione <em><?=$versione ?></em></div>

<div class="menubar">
<span class="link_menu"><a href="anagrafica.php?ts=<?=$ts ?>">Anagrafica</a></span>
<span class="link_menu"><a href="mod_pz.php?idpz=nuovo&amp;ts=<?=$ts ?>">Nuovo</a></span>
<span class="link_menu"><a href="ricerca.php?ts=<?=$ts ?>">Ricerca</a></span>
<span class="link_menu"><a href="stat.php?ts=<?=$ts ?>">Statistiche</a></span>
<span class="link_menu"><a href="logout.php?ts=<?=$ts ?>">Logout</a></span>
<span class="link_menu"><a href="logout.php?ts=<?=$ts ?>&amp;backup=si">Logout+Backup</a></span>
</div>

<?
}
else die ('Accesso non autorizzato');

?>

