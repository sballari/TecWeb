<?php
//include "../class/DBmanager.php";
include "../class/Factory.php";

$dbM = new DBmanager("localhost","root","","squittydb" );
$dbM->connect();
$fact = new Factory($dbM);
$serviceList = $fact->getRequestList("cristina.polletto@gmail.com");
echo $serviceList[0]->getUserNote();


?>
