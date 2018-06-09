<?php
require_once("../models/User.php");
require_once("../services/Factory.php");
require_once("../services/Manipulator.php");
require_once("../services/DBManager.php");
require_once("../models/MassiveOrder.php");
//include "../class/Authenticator.php";


$dbM = new DBmanager("localhost","root","","i_tesori_di_squitty_mod" );
$dbM->connect();
//$fact = new Factory($dbM);
//$serviceList = $fact->getRequestList("cristina.polletto@gmail.com");
//echo $serviceList[0]->getUserNote();
$man=new Manipulator($dbM);
$user=new User("tullio2@gmail.com","b","b","b","All_ingrosso");
//echo var_dump($man->insertUser($user))."\n";
$prod=new Product("img/prodotti/tiramisu.jpep","product","product","All_ingrosso","product");
//echo var_dump($man->insertProduct($prod));
$prenotazione=new MassiveOrder("Via Roma 13","settimanale","2018-01-08T00:00:00+01:00","in_lavorazione",$user,"2018-01-10T00:00:00",null);
//__construct($devAdr, $periodicity,$reiceveRequestDateTime,$status,User $user,$deliveryDateTime,$key)
$prenotazione->insertProduct($prod);
$prenotazione->insertProduct($prod);
//$aut = new Authenticator($dbM);



//echo var_dump($aut->validateUser("carlo.bianchi@gmail.com", '"pass"'));

echo var_dump($man->insertRequest($prenotazione));
//echo mysqli_error($dbM->no());
//echo var_dump($man->addProductToOrder("salame alla merda",1,"Al minuto"));
?>
