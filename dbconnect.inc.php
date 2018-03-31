<?php

$conn = mysql_connect($dbhost,$dbuser,$dbpass)
or die("Unable to connect to MySQL server!");

mysql_select_db($dbname,$conn)
or die("Unable to select $dbname database!");

mysql_query ("SET NAMES 'UTF8'");

mysql_set_charset('utf8');

?>

