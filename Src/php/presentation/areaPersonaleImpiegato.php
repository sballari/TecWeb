<!DOCTYPE HTML>
<html lang ="it">
  <?php
    session_start();
    require_once("CommonHtmlElement.php");
    require_once("../services/Factory.php");
    require_once("../services/DBmanager.php");
    require_once("../models/User.php");
    require_once("../models/Product.php");
    require_once("ElementDisplayer.php");

    $h = new CommonHtmlElement();
    $h->printHead("Area personale impiegato", "pagina dedicata ai impiegati della pasticceria", "gestione ordini, aggiunta prodotti, utenti");
    $d = new DBmanager("localhost", "root", "", "sballari");
    $d->connect();
    $f = new Factory($d);
    $disp = new ElementDisplayer();
  ?>
  <body onload='creaStatistiche()'>
  <?php
        $h->printMobileMenu("accountImpiegato");
    ?>
		<?php
			$h->createheader("accountImpiegato");

      if (!isset($_SESSION['Email'])){
        $h->printInternalMenu("errore");
        echo "<div id='content'>";
        echo "<div class='contentElement'>";
        echo "<h2>ERRORE</h2>";
        echo "<p>Non sei autenticato presso il nostro sistema! Procedere alla creazione di un account o all'accesso.
        <a href='logIn.php'>Vai alla pagina di <span lang='en'>Log in</span></a> ,
        <a href='signUp.php'>Vai alla pagina di  <span lang='en'>Sign up</span></a>.</p>";
        echo "</div>";
        echo "</div>";
      }
      else{
        $u = $f->getUser($_SESSION['Email']);
        $t = $u->getUserType();
        $d->disconnect();
        if($t != "Impiegato"){
          $h->printInternalMenu("errore");
          echo "<div id='content'>";
          echo "<div class='contentElement'>";
          echo "<h2>ERRORE</h2>";
          echo "<p>Non sei autenticato presso il nostro sistema! Procedere alla creazione di un account o all'accesso.
          <a href='logIn.php'>Vai alla pagina di <span lang='en'>Log in</span></a> ,
          <a href='signUp.php'>Vai alla pagina di  <span lang='en'>Sign up</span></a>.</p>";
          echo "</div>";
          echo "</div>";
        }
        else{
          $h->printInternalMenu("accountImpiegato");
          echo "<div id='content'>";
          echo "<div id='info' class='contentElement'>";
          echo "<h2>INFO</h2>";
          echo "<p>Bentornato " . $_SESSION['Email'].", utente di tipo : ".$u->getUserType()."</p>";
          echo "</div>";
          if(!isset($_GET) || count($_GET)==0){
            if(isset($_SESSION['messaggioAreaImp'])){
              echo "<div id='messaggio' class='contentElement'>";
              echo "".$_SESSION['messaggioAreaImp'];
              echo "</div>";
              unset($_SESSION['messaggioAreaImp']);
            }
            else{
              echo "<div id='messaggio' class='contentElement'>";
              echo "<p>Nella lista dei link interni si trovano i seguenti link: Ordini, Utenti, Prodotti. Tramite il link Ordini potra visualizzare la tabella
              dei ordini in base di tipo del ordine scelto. Dopo aver scelto un ordine potra: visualizzarlo in modo piu dettagliato, cambiare lo stato del ordine
              da in_lavorazione in passato, cancellare l'ordine. Tramite il link Utenti potra visualizzare la tabella dei utenti. Dopo aver scelto un utente
              potra: visualizzarlo in modo piu dettagliato o cancellare l'utente. Tramite il link Prodotti potra visualizzare la tabella dei prodotti.
              Dopo aver scelto un prodotto potra: visualizzarlo in modo piu dettagliato, modificare o cancellare l'prodotto. ";
              echo "</div>";
            }
          }
          else{
            $_SESSION['operazione'] = $_GET['operazione'];
            if($_GET['operazione'] == "logout"){
              $_SESSION['buttonPremuto']="logout";
              header("Location: ConfirmPageImpiegato.php");
            }
            elseif($_GET['operazione'] == "closeaccount"){
              $_SESSION['buttonPremuto']="closeaccount";
              header("Location: ConfirmPageImpiegato.php");
            }
            else{

             $disp->printOperationElementImpiegato($_GET['operazione']);
            }
          }
          echo "</div>";
        }
      }

      $h->createStatisticDiv();
      $h->printContatti();
      $h->printFooter();
    ?>
  </body>
</html>
