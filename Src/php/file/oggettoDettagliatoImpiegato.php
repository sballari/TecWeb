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
    $h->printHead("Oggetto Dettagliato", "dettagli dell'oggetto", "ordini, utenti, prodotti");
        //PROVA
                //$email = "cristina.polletto@gmail.it";
                //$s= $f->getRequestList($email);
                //$_SESSION['Email']="$email";
                //$_SESSION['richiestaDettaglio']=$s[0];
        //FINE PROVA

 ?>
<body>
    <div id="accessBar">
    </div>

    <?php
  	   $h->createheader("oggettoDettagliatoImpiegato");


        if (!isset($_SESSION['Email'])) {
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
          if($t != "Impiegato"){
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
            $h->printInternalMenu("oggettoDettagliatoImpiegato");
            echo "<div id='content'>";
            echo "<div id='info' class='contentElement'>";
            echo "<h3>INFO</h3>";
            echo "<p>Bentornato " . $_SESSION['Email'].", utente di tipo : ".$u->getUserType()."</p>";
            echo "</div>";

            if (isset($_SESSION['richiestaDettagliataImp'])){
              $r = unserialize($_SESSION['richiestaDettagliataImp']);
              unset($_SESSION['richiestaDettagliataImp']);
                $h->printRichiestaDettagliataDiv($r);

            }
            elseif(isset($_SESSION['utenteDettagliato'])){
              $ut = unserialize($_SESSION['utenteDettagliato']);
              unset($_SESSION['utenteDettagliato']);
                $h->printUtenteDettagliatoDiv($ut);
            }
            elseif(isset($_SESSION['prodottoDettagliato'])){
              $pr = unserialize($_SESSION['prodottoDettagliato']);
              unset($_SESSION['prodottoDettagliato']);
                $h->printProdottoDettagliatoDiv($pr);
            }
            else {

                echo "<div class='contentElement'>
                    <h3>ERRORE</h3>
                    <p> per poter visualizzare un oggetto dettagliato deve prima selezionare un oggetto.
                     Ci dispiace per il disagio.
                    Le auguriamo una formaggiosa giornata.
                </div>";
            }
        }
      }

	  $h->printContatti();
      $h->printFooter();
      $h->printMobileMenu("casa");
    ?>


</body>
</html>
