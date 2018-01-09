<?php
//include "../class/DBmanager.php";
include "../class/Factory.php";
include "../class/Manipulator.php";
include "../class/RetailOrder.php";

$dbM = new DBmanager("localhost","root","","squittydb" );
$dbM->connect();
//$fact = new Factory($dbM);
//$serviceList = $fact->getRequestList("cristina.polletto@gmail.com");
//echo $serviceList[0]->getUserNote();
$man=new Manipulator($dbM);
$user=new User("tullio.vardanega@gmail.com","orcaloca","tullio","vardanega","Al minuto");
//echo var_dump($man->insertUser($user));
$prod=new Product("img/prodotti/tiramisu.jpep","pot","vovi e scroto","Al minuto","salame alla scroto");
//echo var_dump($man->insertProduct($prod));
$prenotazione=new RetailOrder("2018-01-08 00:00:00","in_lavorazione",$user,"banana","2018-01-10 00:00:00",null);
$prenotazione->insertProduct($prod);
echo var_dump($man->insertRequest($prenotazione));
//echo var_dump($man->addProductToOrder("salame alla merda",1,"Al minuto"));
?>
