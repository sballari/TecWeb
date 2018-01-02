<?php
//include "../class/DBmanager.php";
include "../class/Factory.php";
		
$dbM = new DBmanager("localhost","root","","squittydb" );
$dbM->connect();
$fact = new Factory($dbM);
//$arr = $fact->getUserList();
//print_r($arr);

?>
