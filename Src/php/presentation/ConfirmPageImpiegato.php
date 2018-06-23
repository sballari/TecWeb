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
    $h->printHead("Pagina di conferma impiegato", "pagina dedicata alla conferma delle operazioni eseguite dall'impiegato", "conferma, annulla");
    $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
    $d->connect();
    $f = new Factory($d);
    $disp = new ElementDisplayer();
  ?>
  <body onload='creaStatistiche()'>
  <?php
        $h->printMobileMenu("casa");
    ?>
    <a name="top"></a>
    <div id="accessBar">
    </div>

		<?php
			$h->createheader("ConfirmPageImpiegato");

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
      else{
        $u = $f->getUser($_SESSION['Email']);
        $t = $u->getUserType();
        $d->disconnect();
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
          $h->printInternalMenu("ConfirmPageImpiegato");
          echo "<div id='content'>";
          echo "<div id='info' class='contentElement'>";
          if(isset($_SESSION['messaggioConfirmImp'])){
            echo "".$_SESSION['messaggioConfirmImp'];
            unset($_SESSION['messaggioConfirmImp']);
          }
          else{
            if(isset($_SESSION['buttonPremuto'])){
              switch($_SESSION['buttonPremuto']){
                case "cancellaRichiesta":
                  if(isset($_SESSION['richiestaCancellata'])){
                    echo "La richiesta che hai scelto di cancellare e la seguente:";
                    $r = unserialize($_SESSION['richiestaCancellata']);
                    $disp->printRichiestaDettagliataDiv($r);
                  }
                  break;
                case "cambiaStato":
                  if(isset($_SESSION['richiestaCambiata'])){
                    $r = unserialize($_SESSION['richiestaCambiata']);
                    echo "La richiesta che hai scelto di cambiare stato e la seguente:";
                    $disp->printRichiestaDettagliataDiv($r);
                  }
                  break;
                case "cancellaUtente":
                  if(isset($_SESSION['utenteCancellato'])){
                    echo "L'utente che hai scelto di cancellare e il seguente:";
                    $ut = unserialize($_SESSION['utenteCancellato']);
                    $disp->printUtenteDettagliatoDiv($ut);
                  }
                  break;
                case "logout":
                  echo "<p>Sei sicuro di voler uscire dal suo account <strong>definitivamente</strong>?</p>";
                  break;
                case "closeaccount":
                  echo "<p>Sei sicuro di voler eliminare il suo account <strong>definitivamente</strong>?</p>";
                  break;
              }
              echo "<form action='../operationManagers/operationManagerImpiegato.php' method='POST'>";
              echo "<fieldset>";
              echo "<legend>Conferma o annulla la sua operazione</legend>";
              echo "<button type='submit' name='conferma'>Conferma</button>";
              echo "<button type='submit' name='annulla'>Annulla</button>";
 		          echo "</fieldset>";
              echo  "</form>";

            }
          }
          echo "</div>";
          echo "</div>";
        }
      }

      $h->createStatisticDiv();
      $h->printContatti();
      $h->printFooter();

    ?>
   </body>
 </html>
