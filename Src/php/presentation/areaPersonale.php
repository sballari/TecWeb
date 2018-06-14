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
    $h->printHead("Area personale", "area personale del cliente", "prenotazione, ordine");
    $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
    $d->connect();
    $f = new Factory($d);
    $disp = new ElementDisplayer();
  ?>
  <body onload='creaStatistiche()'>

		<?php
			$h->createheader("account");
      $h->printInternalMenu("account");
    ?>

    <div id="content">
      <?php
        if(!isset($_SESSION['Email'])){
          echo "<div class='contentElement'>";
          echo "<h3>ERRORE</h3>";
          echo "<p>Non sei autenticato presso il nostro sistema! Procedere alla creazione di un account o all'accesso.
          <a href='logIn.php'>Vai alla pagina di <span lang='en'>Log in</span></a>
          <a href='signUp.php'>Vai alla pagina di  <span lang='en'>Sign up</span></a>.</p>";
          echo "</div>";
        }
        else{
          $u = $f->getUser($_SESSION['Email']);
          $t = $u->getUserType();
          $d->disconnect();
          echo "<div id='info' class='contentElement'>";
          echo "<h3>INFO</h3>";
          echo "<p>Bentornato " . $_SESSION['Email'].", utente di tipo : ".$u->getUserType()."</p>";
          echo "</div>";
          if(!isset($_GET) || count($_GET)==0){
            if(isset($_SESSION['messaggioArea'])){
              echo "<div id='messaggio' class='contentElement'>";
              echo "".$_SESSION['messaggioArea'];
              echo "</div>";
              unset($_SESSION['messaggioArea']);
            }
            else{
              $disp->printOperationElement("prenotazione", $t);
            }
          }
          else{
            if($_GET['operazione']=='logout'){
              $_SESSION['submitPremuto']="logout";
              header("Location: ConfirmPage.php");
            }
            elseif($_GET['operazione']=='closeaccount'){
              $_SESSION['submitPremuto']="closeaccount";
              header("Location: ConfirmPage.php");
            }
            else{
              if(isset($_SESSION['submitPremuto']) && isset($_SESSION['contatore'])){
                $c = $_SESSION['contatore'];
                for($i=1; $i<=$c; $i++){
                  unset($_SESSION[$_SESSION['listaProdotti'.$i]]);
                  unset($_SESSION['listaProdotti'.$i]);
                }
                unset($_SESSION['contatore']);
                unset($_SESSION['submitPremuto']);

              }
              $disp->printOperationElement($_GET['operazione'], $t);
            }
          }
        }
      ?>
    </div>
    <?php
      $h->createStatisticDiv();
      $h->printContatti();
      $h->printFooter();
      $h->printMobileMenu("account");
    ?>
  </body>
</html>
