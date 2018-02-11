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




if(isset($_POST['richiestaDettagliataImp'])){
  $reqS = $f->getTypeRequestList("Servizio");
  $lengthS = count($reqS);
    $reqI = $f->getTypeRequestList("All_ingrosso");
    $lengthI = count($reqI);
      $reqM = $f->getTypeRequestList("Al minuto");
        $lengthM = count($reqM);
  if(isset($_POST['request'])){

      $pos = substr($_POST['request'], 7);
      if($pos <= $lengthS){
        $x = $reqS[$pos-1];
      }
      elseif($pos <= ($lengthI + $lengthS)){
        $x = $reqI[$pos-$lengthS-1];
      }
      elseif($pos <= ($lengthI + $lengthS + $lengthM)){
        $x = $reqM[$pos-$lengthS-$lengthI-1];
      }
      else{
        $_SESSION['messaggioAreaImp'] = "Qualcosa &egrave; andato storto!";
        header("Location: areaPersonaleImpiegato.php");
      }


      $_SESSION['richiestaDettagliataImp'] = serialize($x);
      header("Location: oggettoDettagliatoImpiegato.php");
    }
  else{


    $_SESSION['messaggioAreaImp'] = "Devi selezionare una richiesta per poter visualizzare la richiesta dettagliatta.";
    header("Location: areaPersonaleImpiegato.php");
  }
}



  if(isset($_POST['utenteDettagliato'])){
    $req = $f->getEntireUserList();
    if(isset($_POST['utente'])){

        $pos = substr($_POST['utente'], 6);

          $x = $req[$pos-1];


        $_SESSION['utenteDettagliato'] = serialize($x);
        header("Location: oggettoDettagliatoImpiegato.php");
      }
    else{


      $_SESSION['messaggioAreaImp'] = "Devi selezionare un utente per poter visualizzare l'utente dettagliatto.";
      header("Location: areaPersonaleImpiegato.php");
    }
  }


    if(isset($_POST['prodottoDettagliato'])){
      $req = $f->getEntireProductList();
      if(isset($_POST['prodotto'])){

          $pos = substr($_POST['prodotto'], 8);

            $x = $req[$pos-1];


          $_SESSION['prodottoDettagliato'] = serialize($x);
          header("Location: oggettoDettagliatoImpiegato.php");
        }
      else{


        $_SESSION['messaggioAreaImp'] = "Devi selezionare un prodotto per poter visualizzare il prodotto dettagliatto.";
        header("Location: areaPersonaleImpiegato.php");
      }
    }






if(isset($_POST['annullaRichiesta'])){
  $req = $f->getRequestList($_SESSION['Email']);
    $id=1;
    foreach($req as $x){
      $st="request" . $id . "";
      $b = isset($_POST[$st]);

      if(isset($_POST[$st])){
        $currentD = "".date("Y-m-d ");
        $deliveryD = "".$x->getDeliveryDateTime();
        if($deliveryD > $currentD){

          $_SESSION['richiestaAnnullata'] = serialize($x);
          $_SESSION['submitPremuto']="annullaRichiesta";
          header("Location: ConfirmPage.php");
          break;
        }
        else{
          $_SESSION['messaggioArea'] = "Non &egrave; possibile rimuovere la richiesta.";
          header("Location: areaPersonale.php");
        }
      }
      $id++;
    }
    if(!isset($_SESSION['richiestaAnnullata'])){
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
    header("Location: areaPersonale.php");
}





  if(isset($_POST['conferma'])){
    switch( $_SESSION['buttonPremuto']){
      case "annullaRichiesta":
        if(isset($_SESSION['richiestaAnnullata'])){
          $m = new Manipulator($d);

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
         $m = new Manipulator($d);
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
        $m = new Manipulator($d);
        $b = $m->removeUser($_SESSION['Email']);

        if($b==false){
          $_SESSION['messaggioConfirm'] = "<p>Qualcosa &egrave; andato storto.</p>";
          header("Location: ConfirmPageImpiegato.php");
        }
        else{
          unset($_SESSION['Email']);
          header("Location: home.php");
        }
        break;

  }
  unset($_SESSION['buttonPremuto']);
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
      header("Location: areaPersonaleImpiegato.php");
      break;
    case "closeaccount":
      header("Location: areaPersonaleImpiegato.php");
      break;

    }
    unset($_SESSION['buttonPremuto']);
}



?>
