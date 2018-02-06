<?php

if(isset($_POST['richiestaDettaglio'])){

  if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/Factory.php") && file_exists("../class/User.php") && file_exists("../class/Product.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){
    require_once("../class/DBmanager.php");
    require_once("../class/Manipulator.php");
    require_once("../class/Factory.php");
    require_once("../class/User.php");
    require_once("../class/RetailOrder.php");
    require_once("../class/MassiveOrder.php");
    require_once("../class/Service.php");}
  else{
    echo "Error: One of the files does not esist.";
    exit;}

  $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
  $d->connect();
  $f = new Factory($d);

  $req = $f->getRequestList($_SESSION['Email']);
  $id=1;
  foreach($req as $x){
    $st="request" . $id . "";
    $b = isset($_POST[$st]);

    if(isset($_POST[$st])){

      $_SESSION['richiestaDettaglio'] = $x;
    }
    $id++;
  }
header("Location: richiestaDettagliata.php");
}



if(isset($_POST['annullaRichiesta'])){
    $_SESSION['submitPremuto']="annullaRichiesta";
    if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/Factory.php") && file_exists("../class/User.php") && file_exists("../class/Product.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){
      require_once("../class/DBmanager.php");
      require_once("../class/Manipulator.php");
      require_once("../class/Factory.php");
      require_once("../class/User.php");
      require_once("../class/RetailOrder.php");
      require_once("../class/MassiveOrder.php");
      require_once("../class/Service.php");}
    else{
      echo "Error: One of the files does not esist.";
      exit;}

    $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
    $d->connect();
    $f = new Factory($d);

    $req = $f->getRequestList($_SESSION['Email']);
    $id=1;
    foreach($req as $x){
      $st="request" . $id . "";
      $b = isset($_POST[$st]);

      if(isset($_POST[$st])){
        $currentD = "".date("Y-m-d ");
        $deliveryD = "".$x->getDeliveryDateTime();
        if($deliveryD > $currentD){
          $b = $m->removeRequest($x->getKey(), $t);
          if($b==false){
            echo "Qualcosa &egrave; andato storto!";
          }
          else{
            echo "La richiesta &egrave stata rimossa.";
          }
        }
        else{
          echo "Non &egrave; possibile rimuovere la richiesta.";
        }
      }
      $id++;
    }

  }


  function clean_input($data) {
    $data = trim($data);
    $data = htmlentities($data);
    $data = strip_tags($data);
    return $data;
  }
  $numeroProdotti = $dataRitiro = $oraRitiro = "";
  $ErrNumeroProdotti = $ErrDataRitiro = $ErrOraRitiro = "";

  if(isset($_POST['prenota'])){
      $_SESSION['submitPremuto']="prenota";
      //$dataRitiro = clean_input($_POST['dataRitiro']);
      //if (!preg_match("//", $dataRitiro)) {		//******** YOU HAVE TO FIX IT*******
        //$ErrDataRitiro = "Invalid date format";
      //}

      //$oraRitiro = clean_input($_POST['oraRitiro']);
      //if (!preg_match("//",$oraRitiro)) {		//******** YOU HAVE TO FIX IT*******
        //$ErrOraRitiro= "Invalid time format";
      //}
      //if(($ErrNumeroProdotti = "") && ($ErrDataRitiro = "") && ($ErrOraRitiro = "")){
    if(file_exists("../class/DBmanager.php") && file_exists("../class/Manipulator.php") && file_exists("../class/Factory.php") && file_exists("../class/User.php") && file_exists("../class/Product.php") && file_exists("../class/Service.php") && file_exists("../class/RetailOrder.php") && file_exists("../class/MassiveOrder.php")){
      require_once("../class/DBmanager.php");
      require_once("../class/Manipulator.php");
      require_once("../class/Factory.php");
      require_once("../class/User.php");
      require_once("../class/RetailOrder.php");
      require_once("../class/MassiveOrder.php");
      require_once("../class/Service.php");}
    else{
      echo "Error: One of the files does not esist.";
      exit;}

    $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
    $d->connect();
    $f = new Factory($d);
    $m = new Manipulator($d);
    $usr = $f->getUser($_SESSION['Email']);
    $usrType = $usr->getUserType();
    $co = $_SESSION['contatore'];

    switch($usrType){
      case "Al minuto":
        $requestDate = date("Y-m-d H:i:s");
        $st = strtotime("".$_POST['dataRitiro']. " ".$_POST['oraRitiro']);

        $deliveryDate = date("Y-m-d H:i:s",$st);
        $r = new RetailOrder($requestDate, "in_lavorazione", $usr, $_POST['decrizioneUtente'], $deliveryDate, NULL);
        for($i=1; $i<=$co; $i++){
          $p = $f->getProduct($_SESSION['listaProdotti'.$i]);
          $y = $_SESSION[$_SESSION['listaProdotti'.$i]];
          for($j=1; $j<=$y; $j++){
            $r->insertProduct($p);
          }
        }
        $b = $m->insertRequest($r);
        if($b==true){
          echo "Successful prenotation!";
        }
        else{
          echo "Something went wrong please try again";
        }
        break;

      case "All_ingrosso":
        $requestDate = date("Y-m-d H:i:s");
        $st = strtotime("".$_POST['dataRitiro']. " ".$_POST['oraRitiro']);

        $deliveryDate = date("Y-m-d H:i:s",$st);
        $r = new MassiveOrder($_POST['indirizzoConsegna'], $_POST['periodicita'], $requestDate, "in_lavorazione", $usr, $deliveryDate, NULL);
        for($i=1; $i<=$co; $i++){
          $p = $f->getProduct($_SESSION['listaProdotti'.$i]);
          $y = $_SESSION[$_SESSION['listaProdotti'.$i]];
          for($j=1; $j<=$y; $j++){
            $r->insertProduct($p);
          }
        }
        $b = $m->insertRequest($r);
        if($b==true){
          echo "<p>Successful prenotation!</p>";
        }
        else{
          echo "Something went wrong please try again";
        }
        break;

      case "Servizio":
        $requestDate = date("Y-m-d H:i:s");
        $st = strtotime("".$_POST['dataRitiro']. " ".$_POST['oraRitiro']);

        $deliveryDate = date("Y-m-d H:i:s",$st);
        $p = $f->getProduct($_POST['listaProdotti']);
        $r = new Service($p, $_POST['personaleRichiesto'], $_POST['risorseNecessarie'], $_POST['indirizzoEvento'], $date, "in_lavorazione", $usr, $deliveryDate, NULL);
        $b = $m->insertRequest($r);
        if($b==true){
          echo "Successful prenotation!";
        }
        else{
          echo "Something went wrong please try again";
        }
        break;
      //}
    }
  }


  if(isset($_POST['nuovoProd'])){
    $_SESSION['submitPremuto']="nuovoProd";
    //Il contatore conta i prodotti aggiunti.
    $c = $_SESSION['contatore'];
    $controllo = 0;
    for($i=1; $i<=$c && $controllo == 0; $i++){
      if($_SESSION['listaProdotti'.$c] == $_POST['listaProdotti']){
        $controllo=1;
        break;
      }
    }
    if($controllo == 0){
      $_SESSION['contatore'] = $_SESSION['contatore'] + 1;
      $c = $_SESSION['contatore'];
      $_SESSION['listaProdotti'.$c] = $_POST['listaProdotti'];
      $_SESSION[$_POST['listaProdotti']] = $_POST['numeroProdotti'];
    }
    else{
      $_SESSION[$_POST['listaProdotti']] = $_SESSION[$_POST['listaProdotti']] + $_POST['numeroProdotti'];
    }
}



if(isset($_POST['closeaccount'])){
      $_SESSION['submitPremuto']="closeaccount";
      echo "<div class = 'contentElement'>";
      echo "<p>Sei sicuro di voler eliminare il tuo account <strong>definitivamente</strong>?</p>";
      echo "</div>";

      $b = $m->removeUser($_SESSION['Email']);
      $diss=$d->disconnect();
      $_SESSION['Email'] = "";

      if($b==false){

        echo "<p>Qualcosa &egrave; andato storto.</p>";
      }
      else{
        header("Location: home.php");
      }
  }


  if(isset($_POST['logout'])){
      $_SESSION['submitPremuto']="logout";
    $_SESSION['Email'] = "";
    header("Location: home.php");
  }
?>
