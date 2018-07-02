<!DOCTYPE HTML>
<html lang ="it">
  <?php
    session_start();
    require_once("../services/DBmanager.php");
    require_once("CommonHtmlElement.php");
    require_once("../services/Manipulator.php");
    require_once("../services/Factory.php");
    require_once("../models/User.php");
    require_once("../models/RetailOrder.php");
    require_once("../models/MassiveOrder.php");
    require_once("../models/Service.php");
    require_once("ElementDisplayer.php");

    $h = new CommonHtmlElement();
    $d = new DBmanager("localhost", "sballari", "cheA6e0fU4bB25bx", "sballari");
    $d->connect();
    $f = new Factory($d);
    $disp = new ElementDisplayer();
    $h->printHead("richiesta", "dettagli della richiesta", "richiesta, dolci, dettagli");
  ?>
  <body onload='creaStatistiche()'>
  <?php
        $h->printMobileMenu("richiestaDettagliata");
    ?>
    <?php
  	  $h->createheader("richiestaDettagliata");
      if(!isset($_SESSION['Email'])){
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
          if($t == "Impiegato"){
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
            $h->printInternalMenu("richiestaDettagliata");
            echo "<div id='content'>";
            echo "<div id='info' class='contentElement'>";
            echo "<h2>INFO</h2>";
            echo "<p>Bentornato " . $_SESSION['Email'].", utente di tipo : ".$u->getUserType()."</p>";
            echo "</div>";

            if (isset($_SESSION['richiestaDettaglio'])){
              $r = unserialize($_SESSION['richiestaDettaglio']);
              unset($_SESSION['richiestaDettaglio']);
              $disp->printRichiestaDettagliataDiv($r);
            }
            else{
              echo "
                <div class='contentElement'>
                    <h2>ERRORE</h2>
                    <p> per poter visualizzare una richiesta dettagliata deve prima selezionare una richiesta. Ci dispiace per il disagio.
                    Le auguriamo una formaggiosa giornata.
                </div>";
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
