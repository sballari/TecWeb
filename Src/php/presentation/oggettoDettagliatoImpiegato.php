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
    $h->printHead("Oggetto Dettagliato", "dettagli dell'oggetto", "ordini, utenti, prodotti");
    $disp = new ElementDisplayer();
  ?>
  <body>
  <?php
        $h->printMobileMenu("oggettoDettagliatoImpiegato");
    ?>

    <?php
  	   $h->createheader("oggettoDettagliatoImpiegato");

       if(!isset($_SESSION['Email'])) {
         $h->printInternalMenu("errore");
         echo "<div id='content'>";
         echo "<div class='contentElement'>";
         echo "<h2>ERRORE</h2>";
         echo "<p>Non sei autenticato presso il nostro sistema! Procedere alla creazione di un account o all'accesso.
            <a href='logIn.php'>Vai alla pagina di <span lang='en'>Log in</span></a> ,
            <a href='signUp.php'>Vai alla pagina di  <span lang='en'>Sign up</span></a>.</p>";
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
           $h->printInternalMenu("oggettoDettagliatoImpiegato");
           echo "<div id='content'>";
           echo "<div id='info' class='contentElement'>";
           echo "<h2>INFO</h2>";
           echo "<p>Bentornato " . $_SESSION['Email'].", utente di tipo : ".$u->getUserType()."</p>";
           echo "</div>";

           if(isset($_SESSION['richiestaDettagliataImp'])){
             $r = unserialize($_SESSION['richiestaDettagliataImp']);
             unset($_SESSION['richiestaDettagliataImp']);
             $disp->printRichiestaDettagliataDiv($r);

           }
           elseif(isset($_SESSION['utenteDettagliato'])){
             $ut = unserialize($_SESSION['utenteDettagliato']);
             unset($_SESSION['utenteDettagliato']);
             $disp->printUtenteDettagliatoDiv($ut);
           }
           elseif(isset($_SESSION['prodottoDettagliato'])){
             $pr = unserialize($_SESSION['prodottoDettagliato']);
             unset($_SESSION['prodottoDettagliato']);
             $disp->printProdottoDettagliatoDiv($pr);
           }
           else{
             echo "<div class='contentElement'>
                    <h2>ERRORE</h2>
                    <p> per poter visualizzare un oggetto dettagliato deve prima selezionare un oggetto.
                     Ci dispiace per il disagio.
                    Le auguriamo una formaggiosa giornata.
                </div>";
           }
           echo "</div>";
           
         }
       }

	     $h->printContatti();
       $h->printFooter();
     ?>
   </body>
</html>
