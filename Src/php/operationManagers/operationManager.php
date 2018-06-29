<?php
  session_start();
  require_once("../services/DBmanager.php");
  require_once("../services/Manipulator.php");
  require_once("../services/Factory.php");
  require_once("../models/User.php");
  require_once("../models/Request.php");
  require_once("../models/RetailOrder.php");
  require_once("../models/MassiveOrder.php");
  require_once("../models/Product.php");
  require_once("../models/Service.php");

  $d = new DBmanager("localhost", "sballari", "Sheishioc1eith6a", "sballari");
  $d->connect();
  $f = new Factory($d);
  $m = new Manipulator($d);

  /*Viene eseguito appena l'utente cliente sceglie un ordine dalla storia dei ordini
  e preme il submit button richiestaDettaglio vissualizzato come "Richiesta dettagliata".*/
  if(isset($_POST['richiestaDettaglio'])){
    $req = $f->getRequestList($_SESSION['Email']);
    if(isset($_POST['request'])){
      $pos = substr($_POST['request'], 7);
      $x = $req[$pos-1];
      $_SESSION['richiestaDettaglio'] = serialize($x);  //Viene salvata $x in SESSION per poter accederla in richiestaDettagliata.php
      header("Location: ../presentation/richiestaDettagliata.php");
    }
    else{
      $_SESSION['messaggioArea'] = "Devi selezionare una richiesta per poter visualizzare la richiesta dettagliatta.";  //Questo messaggio viene visualizzato in areaPersonale.php
      header("Location: ../presentation/areaPersonale.php");
    }
  }


  /*Viene eseguito appena l'utente cliente sceglie un ordine dalla storia dei ordini
  e preme il submit button annullaRichiesta vissualizzato come "Annulla richiesta"*/
  if(isset($_POST['annullaRichiesta'])){
    $req = $f->getRequestList($_SESSION['Email']);
    if(isset($_POST['request'])){
      $pos = substr($_POST['request'], 7);
      $x = $req[$pos-1];

      $currentD = "Sheishioc1eith6a".date("Y-m-d ");
      $deliveryD = "Sheishioc1eith6a".$x->getDeliveryDateTime();
      if($deliveryD > $currentD){
        $_SESSION['richiestaAnnullata'] = serialize($x);
        $_SESSION['submitPremuto']="annullaRichiesta";
        header("Location: ../presentation/ConfirmPage.php");
      }
      else{
        $_SESSION['messaggioArea'] = "Non &egrave; possibile rimuovere la richiesta. La richiesta da annullare deve essere in lavorazione e l'annulla deve essere fatta almeno un giorno prima della consegna.";
        header("Location: ../presentation/areaPersonale.php");
      }
    }
    else{
      $_SESSION['messaggioArea'] = "Devi selezionare una richiesta per poter procedere con l'operazione di annulla.";
      header("Location: ../presentation/areaPersonale.php");
    }
  }


  function clean_input($data) {
    $data = trim($data);
    $data = htmlentities($data);
    $data = strip_tags($data);
    return $data;
  }
  $numeroProdotti = $dataRitiro = $oraRitiro = "Sheishioc1eith6a";
  $ErrNumeroProdotti = $ErrDataRitiro = $ErrOraRitiro = "Sheishioc1eith6a";

  if(isset($_POST['prenota'])){
    $_SESSION['submitPremuto']="prenotaRichiesta";

    $m = new Manipulator($d);
    $usr = $f->getUser($_SESSION['Email']);
    $usrType = $usr->getUserType();
    if(isset($_SESSION["contatore"])){
      $co = $_SESSION['contatore'];
    }
    switch($usrType){
      case "Al minuto":
        $requestDate = date("Y-m-d H:i:s");
        $st = strtotime("Sheishioc1eith6a".$_POST['dataRitiro']. " ".$_POST['oraRitiro']);

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
        $st = strtotime("Sheishioc1eith6a".$_POST['dataRitiro']. " ".$_POST['oraRitiro']);
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
        $st = strtotime("Sheishioc1eith6a".$_POST['dataRitiro']. " ".$_POST['oraRitiro']);
        $deliveryDate = date("Y-m-d H:i:s",$st);
        $p = $f->getProduct($_POST['listaProdotti']);
        $r = new Service($p, $_POST['personaleRichiesto'], $_POST['risorseNecessarie'], $_POST['indirizzoEvento'], $requestDate, "in_lavorazione", $usr, $deliveryDate, NULL);
        break;
    }
    $_SESSION['richiestaPrenotata'] = serialize($r);
    header("Location: ../presentation/ConfirmPage.php");
  }



  if(isset($_POST['nuovoProd'])){
    $_SESSION['submitPremuto']="nuovoProd";
    //Il contatore conta i prodotti aggiunti.
    if(!isset($_SESSION['contatore'])){
      $_SESSION['contatore'] = 0;
    }
    $c = $_SESSION['contatore'];
    $controllo = 0;
    for($i=1; $i<=$c && $controllo == 0; $i++){
      if($_SESSION['listaProdotti'.$i] == $_POST['listaProdotti']){
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
    header("Location: ../presentation/areaPersonale.php");
}



  if(isset($_POST['conferma'])){
    switch( $_SESSION['submitPremuto']){
      case "annullaRichiesta":
        if(isset($_SESSION['richiestaAnnullata'])){
          $m = new Manipulator($d);
          $r = unserialize($_SESSION['richiestaAnnullata']);
          $b = $m->removeRequest($r->getKey(), $r->getType());
          unset($_SESSION['richiestaAnnullata']);
          if($b==false){
            $_SESSION['messaggioConfirm'] = "Qualcosa &egrave; andato storto!";
            header("Location: ../presentation/ConfirmPage.php");
          }
          else{
            $_SESSION['messaggioConfirm'] = "La richiesta &egrave stata rimossa.";
            header("Location: ../presentation/ConfirmPage.php");
          }
        }
        break;

      case "prenotaRichiesta":
        if(isset($_SESSION['richiestaPrenotata'])){
         $r = unserialize($_SESSION['richiestaPrenotata']);
         $m = new Manipulator($d);
         $b = $m->insertRequest($r);
         unset($_SESSION['richiestaPrenotata']);
         if(isset($_SESSION["contatore"])){
           $c = $_SESSION['contatore'];
    	     for($i=1; $i<=$c; $i++){
    			   unset($_SESSION[$_SESSION['listaProdotti'.$i]]);
    			   unset($_SESSION['listaProdotti'.$i]);
    		   }
           unset($_SESSION['contatore']);
         }
         if($b==false){
           $_SESSION['messaggioConfirm'] = "Qualcosa &egrave; andato storto!";
           header("Location: ../presentation/ConfirmPage.php");
         }
         else{
           $_SESSION['messaggioConfirm'] = "La richiesta &egrave stata inserita.";
           header("Location: ../presentation/ConfirmPage.php");
         }
       }
       break;

      case "logout":
        unset($_SESSION['Email']);
        header("Location: ../presentation/home.php");
        break;

      case "closeaccount":
        $m = new Manipulator($d);
        $b = $m->removeUser($_SESSION['Email']);
        if($b==false){
          $_SESSION['messaggioConfirm'] = "<p>Qualcosa &egrave; andato storto.</p>";
          header("Location: ../presentation/ConfirmPage.php");
        }
        else{
          unset($_SESSION['Email']);
          header("Location: ../presentation/home.php");
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
          header("Location: ../presentation/ConfirmPage.php");
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
          header("Location: ../presentation/ConfirmPage.php");
        }
        break;

      case "logout":
        header("Location: ../presentation/areaPersonale.php");
        break;

      case "closeaccount":
        header("Location: ../presentation/areaPersonale.php");
        break;
    }
    unset($_SESSION['submitPremuto']);
  }
?>
