<?php
//include "../class/DBmanager.php";
include "../class/Factory.php";
include "../class/Manipulator.php";
include "../class/RetailOrder.php";
include "../class/MassiveOrder.php";
include "../class/Authenticator.php";


$dbM = new DBmanager("localhost","root","","squittydb" );
$dbM->connect();
//$fact = new Factory($dbM);
//$serviceList = $fact->getRequestList("cristina.polletto@gmail.com");
//echo $serviceList[0]->getUserNote();
$man=new Manipulator($dbM);
$user=new User("tullio2@gmail.com","b","b","b","All_ingrosso");
//echo var_dump($man->insertUser($user))."\n";
$prod=new Product("img/prodotti/tiramisu.jpep","pot","vovi e scroto","All_ingrosso","salame 30cm");
//echo var_dump($man->insertProduct($prod));
$prenotazione=new MassiveOrder("Via sborina 13","settimanale","2018-01-08T00:00:00+01:00","in_lavorazione",$user,"2018-01-10T00:00:00",null);
//__construct($devAdr, $periodicity,$reiceveRequestDateTime,$status,User $user,$deliveryDateTime,$key)
$prenotazione->insertProduct($prod);
$prenotazione->insertProduct($prod);
$aut = new Authenticator($dbM);



echo var_dump($aut->validateUser("silvia.rossi@gmail.com", "pass"));

//echo var_dump($man->insertRequest($prenotazione));
//echo mysqli_error($dbM->no());
//echo var_dump($man->addProductToOrder("salame alla merda",1,"Al minuto"));
?>
