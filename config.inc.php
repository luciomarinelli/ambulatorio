<?php

//Parametri configurazione database MySQL
$dbhost='sql.YOURDOMAIN.com';
$dbname="DB-NAME";
$dbuser="B-USERNAME";
$dbpass="DB-PASSWORD";

//Titolo nel tag <title>
$conf_head_title="TITLE SHOWN IN THE TITLE BAR";

//Titolo principale
$conf_titolo="HEADER IN THE MAIN PAGE";

//Titoletto (sotto il titolo principale)
$conf_titoletto="SUBTITLE IN THE MAIN PAGE";

$from_emailaddress = "FROM ADDRESS FOR DB BACKUP";// your email address to show who the email is from (should be different $to_emailaddress)
$to_emailaddress = "TO ADDRESS FOR DB BACKUP"; // your email address to send backup files to
                       //best to specify an email address on a different server than the MySQL db  ;-)

//Lista dei luoghi di visita (elenco voci nell'array)
$lista_luoghi=array("Telefono/mail", "Domicilio", "Clinica");

?>
