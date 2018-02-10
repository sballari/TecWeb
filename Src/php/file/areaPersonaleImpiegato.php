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
      $h->printHead("Area personale impiegato", "pagina dedicata ai impiegati della pasticceria", "gestione ordini, aggiunta prodotti, utenti");
      $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
      $d->connect();
      $f = new Factory($d);
 ?>
<body>
    <a name="top"></a>
    <div id="accessBar">
    </div>

		<?php
			$h->createheader("account");
      $h->printInternalMenu("accountImpiegato");
    ?>
<div id="content">
  <?php
  if (!isset($_SESSION['Email'])){
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
         echo "<div id='messaggio' class='contentElement'>";
         echo "<p>Nella lista dei link interni si trovano i seguenti link: Ordini, Utenti, Prodotti.</br> Tramite il link Ordini potra visualizzare la tabella
         dei ordini in base di tipo del ordine scelto. Dopo aver scelto un ordine potra: visualizzarlo in modo piu dettagliato, cambiare lo stato del ordine
         da in_lavorazione in passato, cancellare l'ordine.</br> Tramite il link Utenti potra visualizzare la tabella dei utenti. Dopo aver scelto un utente
         potra: visualizzarlo in modo piu dettagliato o cancellare l'utente.</br> Tramite il link Prodotti potra visualizzare la tabella dei prodotti.
         Dopo aver scelto un prodotto potra: visualizzarlo in modo piu dettagliato, modificare o cancellare l'prodotto.</br> ";
         echo "</div>";
       }
     }
     else{
       if($_GET['operazione'] == "logout"){
         $_SESSION['buttonPremuto']="logout";
         header("Location: ConfirmPageImpiegato.php");
       }
       elseif($_GET['operazione'] == "closeaccount"){
         $_SESSION['buttonPremuto']="closeaccount";
         header("Location: ConfirmPageImpiegato.php");
       }
       else{
         if(isset($_SESSION['checkM'])){
           $h->printOperationElementImpiegato($_GET['operazione'], "Al minuto")
         }
         if(isset($_SESSION['checkI'])){
           $h->printOperationElementImpiegato($_GET['operazione'], "All_ingrosso")
         }
         if(isset($_SESSION['checkS'])){
           $h->printOperationElementImpiegato($_GET['operazione'], "Servizio")
         }
         if(!isset($_SESSION['checkM']) && !isset($_SESSION['checkI']) && !isset($_SESSION['checkS'])){
           $h->printFormCategorie();
         }
       }

    }

 }
?>
</div>

<?php
      $h->printContatti();
      $h->printFooter();
      $h->printMobileMenu("home");
    ?>
    </body>
    </html>
