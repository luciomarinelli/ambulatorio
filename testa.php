<?php

require ("config.inc.php");
include ("versione.inc.php");

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
or die("Impossibile collegarsi al server MySQL!");

mysql_select_db($dbname,$conn)
or die("Impossibile selezionare il database $dbname!");

require ("funzioni.inc.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?=$conf_head_title ?></title>

<meta charset="UTF-8" />
<meta name="author" content="Lucio Marinelli" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" media="all" href="ambulatorio_all.css">
<link rel="stylesheet" type="text/css" media="handheld, only screen and (max-width: 640px)" href="ambulatorio_mobile.css">

<script language="JavaScript">
<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
h = screen.height-50;
w = h*1.3;
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width='+w+',height='+h+'');");
}
// End -->
</script>

<script language="JavaScript">

<!-- Begin
 function putFocus(formInst, elementInst) {
  if (document.forms.length > 0) {
   document.forms[formInst].elements[elementInst].focus();
  }
 }
// The second number in the "onLoad" command in the body
// tag determines the form's focus. Counting starts with '0'
//  End -->
</script>

</head>

<body onLoad="putFocus(0,0);">

<div class="titolo"><?=$conf_titolo ?></div>
<div class="titoletto"><?=$conf_titoletto ?></div>

