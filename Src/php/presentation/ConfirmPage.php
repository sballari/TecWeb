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
    $h->printHead("Pagina di conferma cliente", "pagina dedicata alla conferma delle operazioni eseguite dal cliente", "conferma, annulla");
    $d = new DBmanager("localhost", "sballari", "cheA6e0fU4bB25bx", "sballari");
    $d->connect();
    $f = new Factory($d);
    $disp = new ElementDisplayer();
  ?>
  <body>
    <?php
        $h->printMobileMenu("home");
    ?>


		<?php
			$h->createheader("ConfirmPage");

      if(!isset($_SESSION['Email'])){
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
        $u = $f->getUser($_SESSION['Email']);
        $t = $u->getUserType();
        $d->disconnect();
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
          $h->printInternalMenu("ConfirmPage");
          echo "<div id='content'>";
          echo "<div id='info' class='contentElement'>";
          if(isset($_SESSION['messaggioConfirm'])){
            echo "".$_SESSION['messaggioConfirm'];
            unset($_SESSION['messaggioConfirm']);
          }
          else{
            if(isset($_SESSION['submitPremuto'])){
              switch($_SESSION['submitPremuto']){
                case "annullaRichiesta":
                  if(isset($_SESSION['richiestaAnnullata'])){
                    echo "La richiesta che hai scelto di annullare e la seguente:";
                    echo "Stampa la richiesta";
                    $r = unserialize($_SESSION['richiestaAnnullata']);
                    $disp->printRichiestaDettagliataDiv($r);

                  }
                  break;
                case "prenotaRichiesta":
                  echo "I dati della sua prenotazione sono i seguenti:";
                  echo "Stampa la richiesta";
                  $r = unserialize($_SESSION['richiestaPrenotata']);
                  $disp->printRichiestaDettagliataDiv($r);
                  break;
                case "logout":
                  echo "<p>Sei sicuro di voler uscire dal suo account <strong>definitivamente</strong>?</p>";
                  break;
                case "closeaccount":
                  echo "<p>Sei sicuro di voler eliminare il suo account <strong>definitivamente</strong>?</p>";
                  break;
              }
              echo "<form action='../operationManagers/operationManager.php' method='POST'>";
              echo "<fieldset>";
              echo "<legend>Conferma o annulla la sua operazione</legend>";
              echo "<button type='submit' name='conferma'>Conferma</button>";
              echo "<button type='submit' name='annulla'>Annulla</button>";
 		          echo "</fieldset>";
              echo  "</form>";
              echo "</div>";
              echo "</div>";
          }
          else{
            echo "".$_SESSION['messaggio'];

          }
        }
      }
    }

    $h->printContatti();
    $h->printFooter();
  ?>
</body>
</html>
