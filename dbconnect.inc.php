<?php

//connect to database
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) echo "DB connection error";

if (!$result = $mysqli->query("SET NAMES 'UTF8'")) echo "Query error";

$mysqli->set_charset("utf8");

?>

