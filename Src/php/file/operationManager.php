<?php
session_start();
  require_once("../class/DBmanager.php");
  require_once("CommonHtmlElement.php");
  require_once("../class/Manipulator.php");
  require_once("../class/Factory.php");
  require_once("../class/User.php");
  require_once("../class/Request.php");
  require_once("../class/RetailOrder.php");
  require_once("../class/MassiveOrder.php");
  require_once("../class/Product.php");
  require_once("../class/Service.php");

  $h = new CommonHtmlElement();
  $h->printHead("Operation manager", "Operation manager", "operation");
  $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
  $d->connect();
  $f = new Factory($d);
  $m = new Manipulator($d);

if(isset($_POST['richiestaDettaglio'])){
  $req = $f->getRequestList($_SESSION['Email']);

    if(isset($_POST['request'])){
      $pos = substr($_POST['request'], 7);
      $x = $req[$pos-1];
      $_SESSION['richiestaDettaglio'] = serialize($x);
      header("Location: richiestaDettagliata.php");
    }
    else{
      $_SESSION['messaggioArea'] = "Devi selezionare una richiesta per poter visualizzare la richiesta dettagliatta.";
      header("Location: areaPersonale.php");
    }

}



if(isset($_POST['annullaRichiesta'])){
  $req = $f->getRequestList($_SESSION['Email']);

  if(isset($_POST['request'])){
    $pos = substr($_POST['request'], 7);
    $x = $req[$pos-1];
        $currentD = "".date("Y-m-d ");
        $deliveryD = "".$x->getDeliveryDateTime();
        if($deliveryD > $currentD){

          $_SESSION['richiestaAnnullata'] = serialize($x);
          $_SESSION['submitPremuto']="annullaRichiesta";
          header("Location: ConfirmPage.php");

        }
        else{
          $_SESSION['messaggioArea'] = "Non &egrave; possibile rimuovere la richiesta. Si possono annullare solo richieste con stato: in lavorazione e almeno un giorno prima della data della consegna.";
          header("Location: areaPersonale.php");
        }

    }
  else{
      $_SESSION['messaggioArea'] = "Devi selezionare una richiesta per poter procedere con l'operazione di annulla.";
      header("Location: areaPersonale.php");
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
      $_SESSION['submitPremuto']="prenotaRichiesta";
      //$dataRitiro = clean_input($_POST['dataRitiro']);
      //if (!preg_match("//", $dataRitiro)) {		//******** YOU HAVE TO FIX IT*******
        //$ErrDataRitiro = "Invalid date format";
      //}

      //$oraRitiro = clean_input($_POST['oraRitiro']);
      //if (!preg_match("//",$oraRitiro)) {		//******** YOU HAVE TO FIX IT*******
        //$ErrOraRitiro= "Invalid time format";
      //}
      //if(($ErrNumeroProdotti = "") && ($ErrDataRitiro = "") && ($ErrOraRitiro = "")){

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
        break;

      case "Servizio":
        $requestDate = date("Y-m-d H:i:s");
        $st = strtotime("".$_POST['dataRitiro']. " ".$_POST['oraRitiro']);

        $deliveryDate = date("Y-m-d H:i:s",$st);
        $p = $f->getProduct($_POST['listaProdotti']);

        $r = new Service($p, $_POST['personaleRichiesto'], $_POST['risorseNecessarie'], $_POST['indirizzoEvento'], $date, "in_lavorazione", $usr, $deliveryDate, NULL);

        break;
      //}
    }

  $_SESSION['richiestaPrenotata'] = serialize($r);

   header("Location: ConfirmPage.php");
  }


  if(isset($_POST['nuovoProd'])){
    $_SESSION['submitPremuto']="nuovoProd";
    //Il contatore conta i prodotti aggiunti.
    $c = $_SESSION['contatore'];
    $controllo = 0;
    for($i=1; $i<=$c && $controllo == 0; $i++){
      if($_SESSION['listaProdotti'.$c] == $_POST['listaProdotti']){
        $controllo=1;

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
    header("Location: areaPersonale.php");
}





  if(isset($_POST['conferma'])){
    switch( $_SESSION['submitPremuto']){
      case "annullaRichiesta":
        if(isset($_SESSION['richiestaAnnullata'])){


          $r = unserialize($_SESSION['richiestaAnnullata']);
          $b = $m->removeRequest($r->getKey(), $r->getType());
          unset($_SESSION['richiestaAnnullata']);
          if($b==false){
            $_SESSION['messaggioConfirm'] = "Qualcosa &egrave; andato storto!";
            header("Location: ConfirmPage.php");
          }
          else{
            $_SESSION['messaggioConfirm'] = "La richiesta &egrave stata rimossa.";
            header("Location: ConfirmPage.php");

          }
        }

        break;
      case "prenotaRichiesta":
       if(isset($_SESSION['richiestaPrenotata'])){
         $r = unserialize($_SESSION['richiestaPrenotata']);

         $b = $m->insertRequest($r);

          unset($_SESSION['richiestaPrenotata']);
          $c = $_SESSION['contatore'];
    		for($i=1; $i<=$c; $i++){
    			unset($_SESSION[$_SESSION['listaProdotti'.$i]]);
    			unset($_SESSION['listaProdotti'.$i]);
    		}
        unset($_SESSION['contatore']);
        if($b==false){
          $_SESSION['messaggioConfirm'] = "Qualcosa &egrave; andato storto!";
          header("Location: ConfirmPage.php");
        }
        else{
          $_SESSION['messaggioConfirm'] = "La richiesta &egrave stata inserita.";
          header("Location: ConfirmPage.php");
        }
      }
      break;

      case "logout":
        unset($_SESSION['Email']);
        header("Location: home.php");
        break;
      case "closeaccount":

        $b = $m->removeUser($_SESSION['Email']);

        if($b==false){
          $_SESSION['messaggioConfirm'] = "<p>Qualcosa &egrave; andato storto.</p>";
          header("Location: ConfirmPage.php");
        }
        else{
          unset($_SESSION['Email']);
          header("Location: home.php");
        }
        break;

  }
  unset($_SESSION['submitPremuto']);
}


if(isset($_POST['annulla'])){
  switch( $_SESSION['submitPremuto']){
    case "annullaRichiesta":
      if(isset($_SESSION['richiestaAnnullata'])){
        unset($_SESSION['richiestaAnnullata']);
        $_SESSION['messaggioConfirm'] = "La richiesta non &egrave stata rimossa.";
        header("Location: ConfirmPage.php");
      }

      break;
    case "prenotaRichiesta":
      if(isset($_SESSION['richiestaPrenotata'])){
        unset($_SESSION['richiestaPrenotata']);
        $c = $_SESSION['contatore'];
      for($i=1; $i<=$c; $i++){
        unset($_SESSION[$_SESSION['listaProdotti'.$i]]);
        unset($_SESSION['listaProdotti'.$i]);
      }
      unset($_SESSION['contatore']);

      $_SESSION['messaggioConfirm'] = "La richiesta non &egrave non e stata inserita.";
      header("Location: ConfirmPage.php");
    }
        break;

    case "logout":
      header("Location: areaPersonale.php");
      break;
    case "closeaccount":
      header("Location: areaPersonale.php");
      break;

    }
    unset($_SESSION['submitPremuto']);
}

$d->disconnect();

?>
