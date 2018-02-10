<!DOCTYPE HTML>
<html lang ="it">
<?php
      session_start();
      require_once ("CommonHtmlElement.php");
      require_once ("../class/Factory.php");
      require_once ("../class/DBmanager.php");
      require_once ("../class/User.php");
      require_once ("../class/Product.php");
      $h = new CommonHtmlElement();
      $h->printHead("Pagina di conferma impiegato", "pagina dedicata alla conferma delle operazioni eseguite dall'impiegato", "conferma, annulla");
      $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
      $d->connect();
      $f = new Factory($d);
 ?>
<body onload='creaStatistiche()'>
    <a name="top"></a>
    <div id="accessBar">
    </div>

		<?php
			$h->createheader("account");
      $h->printInternalMenu("ConfirmPageImpiegato");
    ?>
<div id="content">
  <?php
  if (!isset($_SESSION['Email'])) {
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
     echo "<div id='info' class='contentElement'>";
     if(isset($_SESSION['messaggioConfirm'])){
       echo "".$_SESSION['messaggioConfirm'];
       unset($_SESSION['messaggioConfirm']);
     }
     else{
     if(isset($_SESSION['buttonPremuto'])){
     switch($_SESSION['buttonPremuto']){
       case "annullaRichiesta":
        if(isset($_SESSION['richiestaAnnullata'])){
          echo "La richiesta che hai scelto di annullare e la seguente:";
          echo "Stampa la richiesta";
          $r = unserialize($_SESSION['richiestaAnnullata']);
          $h->printRichiestaDettagliataDiv($r);

        }
        break;
      case "prenotaRichiesta":

       echo "I dati della sua prenotazione sono i seguenti:";
       echo "Stampa la richiesta";
       $r = unserialize($_SESSION['richiestaPrenotata']);

       $h->printRichiestaDettagliataDiv($r);


        break;
      case "logout":
        echo "<p>Sei sicuro di voler uscire dal suo account <strong>definitivamente</strong>?</p>";

        break;
      case "closeaccount":
        echo "<p>Sei sicuro di voler eliminare il suo account <strong>definitivamente</strong>?</p>";

        break;
      }
     echo "<form action='operationManager.php' method='POST'>";
     echo "<fieldset>";
     echo "<legend>Conferma o annulla la sua operazione</legend>";
     echo "<button type='submit' name='conferma'>Conferma</button>";
     echo "<button type='submit' name='annulla'>Annulla</button>";
 		 echo "</fieldset>";
     echo  "</form>";
     echo "</div>";
   }
   else{
     echo "".$_SESSION['messaggio'];
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
