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

  $d = new DBmanager("localhost", "root", "", "sballari");
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
        header("Location: ../presentation/areaPersonaleImpiegato.php");
      }

      $_SESSION['richiestaDettagliataImp'] = serialize($x);
      header("Location: ../presentation/oggettoDettagliatoImpiegato.php");
    }
  else{
    $_SESSION['messaggioAreaImp'] = "Devi selezionare una richiesta per poter visualizzare la richiesta dettagliatta.";
    header("Location: ../presentation/areaPersonaleImpiegato.php");
  }
}



  if(isset($_POST['utenteDettagliato'])){
    $req = $f->getEntireUserList();
    if(isset($_POST['utente'])){
        $pos = substr($_POST['utente'], 6);
        $x = $req[$pos-1];
        $_SESSION['utenteDettagliato'] = serialize($x);
        header("Location: ../presentation/oggettoDettagliatoImpiegato.php");
      }
    else{
      $_SESSION['messaggioAreaImp'] = "Devi selezionare un utente per poter visualizzare l'utente dettagliatto.";
      header("Location: ../presentation/areaPersonaleImpiegato.php");
    }
  }


    if(isset($_POST['prodottoDettagliato'])){
      $req = $f->getEntireProductList();
      if(isset($_POST['prodotto'])){
          $pos = substr($_POST['prodotto'], 8);
          $x = $req[$pos-1];
          $_SESSION['prodottoDettagliato'] = serialize($x);
          header("Location: ../presentation/oggettoDettagliatoImpiegato.php");
        }
      else{
        $_SESSION['messaggioAreaImp'] = "Devi selezionare un prodotto per poter visualizzare il prodotto dettagliatto.";
        header("Location: ../presentation/areaPersonaleImpiegato.php");
      }
    }




if(isset($_POST['cancellaRichiesta'])){
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
        header("Location: ../presentation/areaPersonaleImpiegato.php");
      }


      $_SESSION['richiestaCancellata'] = serialize($x);
      $_SESSION['buttonPremuto'] = "cancellaRichiesta";
      header("Location: ../presentation/ConfirmPageImpiegato.php");
    }
  else{


    $_SESSION['messaggioAreaImp'] = "Devi selezionare una richiesta per poter procedere con l'operazione di annulla.";
    header("Location: ../presentation/areaPersonaleImpiegato.php");
  }
  }




  if(isset($_POST['cambiaStato'])){
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
          header("Location: ../presentation/areaPersonaleImpiegato.php");
        }

        if($x->getStatus() == "in_lavorazione"){
          $_SESSION['richiestaCambiata'] = serialize($x);
          $_SESSION['buttonPremuto'] = "cambiaStato";
          header("Location: ../presentation/ConfirmPageImpiegato.php");
        }
        else{
          $_SESSION['messaggioAreaImp'] = "La richiesta scelta e gia in stato passato.";
          header("Location: ../presentation/areaPersonaleImpiegato.php");
        }
      }
      else{
        $_SESSION['messaggioAreaImp'] = "Devi selezionare una richiesta per poter procedere con l'operazione di cambia stato.";
        header("Location: ../presentation/areaPersonaleImpiegato.php");
      }
    }



    if(isset($_POST['cancellaUtente'])){
      $req = $f->getEntireUserList();
      if(isset($_POST['utente'])){
          $pos = substr($_POST['utente'], 6);
          $x = $req[$pos-1];

          $_SESSION['utenteCancellato'] = serialize($x);
          $_SESSION['buttonPremuto'] = "cancellaUtente";
          header("Location: ../presentation/ConfirmPageImpiegato.php");
        }
      else{
        $_SESSION['messaggioAreaImp'] = "Devi selezionare un utente per poter procedere con l'operazione di cancella.";
        header("Location: ../presentation/areaPersonaleImpiegato.php");
      }
    }




    if(isset($_POST['cancellaProdotto'])){
      $req = $f->getEntireProductList();
      if(isset($_POST['prodotto'])){
          $pos = substr($_POST['prodotto'], 8);
          $x = $req[$pos-1];

          $_SESSION['prodottoCancellato'] = serialize($x);
          $_SESSION['buttonPremuto'] = "cancellaProdotto";
          header("Location: ../presentation/ConfirmPageImpiegato.php");
        }
      else{
        $_SESSION['messaggioAreaImp'] = "Devi selezionare un prodotto per poter procedere con l'operazione di cancella.";
        header("Location: ../presentation/areaPersonaleImpiegato.php");
      }
    }





  if(isset($_POST['conferma'])){
    switch( $_SESSION['buttonPremuto']){
      case "cancellaRichiesta":
        if(isset($_SESSION['richiestaCancellata'])){
          $m = new Manipulator($d);

          $r = unserialize($_SESSION['richiestaCancellata']);
          $b = $m->removeRequest($r->getKey(), $r->getType());
          unset($_SESSION['richiestaCancellata']);
          if($b==false){
            $_SESSION['messaggioConfirmImp'] = "Qualcosa &egrave; andato storto!";
            header("Location: ../presentation/ConfirmPageImpiegato.php");
          }
          else{
            $_SESSION['messaggioConfirmImp'] = "La richiesta &egrave stata rimossa.";
            header("Location: ../presentation/ConfirmPageImpiegato.php");

          }
        }

        break;
        case "cambiaStato":
          if(isset($_SESSION['richiestaCambiata'])){
            $m = new Manipulator($d);

            $r = unserialize($_SESSION['richiestaCambiata']);

            switch($r->getType()){
              case "Servizio":
                $b = $d->submitQuery("UPDATE richiesta_servizio SET stato_ordine = 'passato' WHERE codice = " . $r->getKey() . "");

                break;
              case "All_ingrosso":
                $b = $d->submitQuery("UPDATE ordine_all_ingrosso SET stato_ordine = 'passato' WHERE codice = " . $r->getKey() . "");
                  break;
              case "Al minuto":
                $b = $d->submitQuery("UPDATE prenotazione SET stato_ordine = 'passato' WHERE codice = " . $r->getKey() . "");
                    break;
            }

            unset($_SESSION['richiestaCambiata']);
            if($b==false){
              $_SESSION['messaggioConfirmImp'] = "Qualcosa &egrave; andato storto!";
              header("Location: ../presentation/ConfirmPageImpiegato.php");
            }
            else{
              $_SESSION['messaggioConfirmImp'] = "La richiesta &egrave stata cabiato in stato passato.";
              header("Location: ../presentation/ConfirmPageImpiegato.php");

            }
          }

          break;

          case "cancellaUtente":
            if(isset($_SESSION['utenteCancellato'])){
              $m = new Manipulator($d);

              $ut = unserialize($_SESSION['utenteCancellato']);
              $e = $ut->getEmail();

              $b = $m->removeUser($e);

              unset($_SESSION['utenteCancellato']);
              if($b==false){
                $_SESSION['messaggioConfirmImp'] = "Qualcosa &egrave; andato storto!";
                header("Location: ../presentation/ConfirmPageImpiegato.php");
              }
              else{
                $_SESSION['messaggioConfirmImp'] = "L'utente &egrave stato rimosso.";
                header("Location: ../presentation/ConfirmPageImpiegato.php");

              }
            }
            break;

            case "cancellaProdotto":
              if(isset($_SESSION['prodottoCancellato'])){
                $m = new Manipulator($d);

                $ut = unserialize($_SESSION['prodottoCancellato']);
                $e = $ut->getName();

                $b = $m->removeProduct($e);

                unset($_SESSION['prodottoCancellato']);
                if($b==false){
                  $_SESSION['messaggioConfirmImp'] = "Qualcosa &egrave; andato storto!";
                  header("Location: ../presentation/ConfirmPageImpiegato.php");
                }
                else{
                  $_SESSION['messaggioConfirmImp'] = "Il prodotto &egrave stato rimosso.";
                  header("Location: ../presentation/ConfirmPageImpiegato.php");

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
          header("Location: ../presentation/ConfirmPageImpiegato.php");
        }
        else{
          unset($_SESSION['Email']);
          header("Location: ../presentation/home.php");
        }
        break;
    }
  unset($_SESSION['buttonPremuto']);
}


if(isset($_POST['annulla'])){
  switch( $_SESSION['buttonPremuto']){
    case "cancellaRichiesta":
      if(isset($_SESSION['richiestaCancellata'])){
        unset($_SESSION['richiestaCancellata']);
        $_SESSION['messaggioConfirmImp'] = "La richiesta non &egrave stata rimossa.";
        header("Location: ../presentation/ConfirmPageImpiegato.php");
      }

      break;
    case "cambiaStato":
        if(isset($_SESSION['richiestaCambiata'])){
          unset($_SESSION['richiestaCambiata']);
          $_SESSION['messaggioConfirmImp'] = "La richiesta non ha cabiato stato.";
          header("Location: ../presentation/ConfirmPageImpiegato.php");
        }

        break;
    case "cancellaUtente":
          if(isset($_SESSION['utenteCancellato'])){
            unset($_SESSION['utenteCancellato']);
            $_SESSION['messaggioConfirmImp'] = "L'utente non &egrave stato rimosso.";
            header("Location: ../presentation/ConfirmPageImpiegato.php");
          }

          break;

    case "cancellaProdotto":
      if(isset($_SESSION['prodottoCancellato'])){
        unset($_SESSION['prodottoCancellato']);
        $_SESSION['messaggioConfirmImp'] = "Il prodotto non &egrave stato rimosso.";
        header("Location: ../presentation/ConfirmPageImpiegato.php");
      }
      break;

    case "logout":
      header("Location: ../presentation/areaPersonaleImpiegato.php");
      break;
    case "closeaccount":
      header("Location: ../presentation/areaPersonaleImpiegato.php");
      break;

    }
    unset($_SESSION['buttonPremuto']);
}
?>
