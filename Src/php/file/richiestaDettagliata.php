<!DOCTYPE HTML>
<html lang ="it"></html>
<?php
session_start();
  require_once("../class/DBmanager.php");
  require_once("CommonHtmlElement.php");
  require_once("../class/Manipulator.php");
  require_once("../class/Factory.php");
  require_once("../class/User.php");
  require_once("../class/RetailOrder.php");
  require_once("../class/MassiveOrder.php");
  require_once("../class/Service.php");


    $h = new CommonHtmlElement();
    $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
    $d->connect();
    $f = new Factory($d);
    $h->printHead("richiesta", "dettagli della richiesta", "richiesta, dolci, dettagli");

 ?>
<body onload='creaStatistiche()'>
    <div id="accessBar">
    </div>

    <?php
  	   $h->createheader("richiestaDettagliata");


          if (!isset($_SESSION['Email'])){
            $h->printInternalMenu("errore");
            echo "<div id='content'>";
            echo "<div class='contentElement'>";
            echo "<h3>ERRORE</h3>";
            echo "<p>Non sei autenticato presso il nostro sistema! Procedere alla creazione di un account o all'accesso.
            <a href='logIn.php'>Vai alla pagina di <span lang='en'>Log in</span></a> ,
            <a href='signUp.php'>Vai alla pagina di  <span lang='en'>Sign up</span></a>.</p>";
            echo "</div>";
        }

        else {
          $u = $f->getUser($_SESSION['Email']);
          $t = $u->getUserType();
          if($t == "Impiegato"){
            $h->printInternalMenu("errore");
            echo "<div id='content'>";
            echo "<div class='contentElement'>";
            echo "<h3>ERRORE</h3>";
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
            echo "<h3>INFO</h3>";
            echo "<p>Bentornato " . $_SESSION['Email'].", utente di tipo : ".$u->getUserType()."</p>";
            echo "</div>";

            if (isset($_SESSION['richiestaDettaglio'])){
              $r = unserialize($_SESSION['richiestaDettaglio']);


              unset($_SESSION['richiestaDettaglio']);
                $h->printRichiestaDettagliataDiv($r);

            }
            else {
                echo "
                <div class='contentElement'>
                    <h3>ERRORE</h3>
                    <p> per poter visualizzare una richiesta dettagliata deve prima selezionare una richiesta. Ci dispiace per il disagio.
                    Le auguriamo una formaggiosa giornata.
                </div>";
            }
        }
      }

    ?>


    </div>

    <?php
    $h->createStatisticDiv();
	  $h->printContatti();
      $h->printFooter();
      $h->printMobileMenu("casa");
    ?>


</body>
</html>
