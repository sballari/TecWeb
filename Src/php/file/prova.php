<?php
include "DBmanager.php";
$dbM = new DBmanager("127.0.0.1","utente","password","squittydb" );
//$dbM->connect();
//$dbM->disconnect();
$dbM->connect();
echo var_dump($dbM->getStatus());
echo var_dump($dbM->submitQuery("SHOW TABLES;"));
?>
