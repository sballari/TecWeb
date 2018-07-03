<!DOCTYPE HTML>
<html lang ="it">
  <?php
      require_once("CommonHtmlElement.php");
      require_once("../services/DBmanager.php");
      require_once("../models/User.php");
      require_once("../services/Factory.php");
      $h = new CommonHtmlElement();
      $h->printHead("LogIn", "area personale", "login, signup");
  ?>
  <body onload='creaStatistiche()'>
  <?php
        $h->printMobileMenu("logIn");
    ?>
    <?php
	    session_start();
      $d = new DBmanager("localhost", "sballari", "cheA6e0fU4bB25bx", "sballari");
      $d->connect();
      $f = new Factory($d);
      if(isset($_SESSION['Email'])){
        $u = $f->getUser($_SESSION['Email']);
        $t = $u->getUserType();
        if($t == "Impiegato"){
          header("Location: areaPersonaleImpiegato.php");
        }
        else{
          header("Location: areaPersonale.php");
        }
      }
	    $h->createheader("logIn");
      $h->printInternalMenu("logIn");
      $d->disconnect();
    ?>
    <div id="content">
      <div id="info" class="contentElement">
      	<h2>INFO</h2>
        <p>Se non hai ancora un account non aspettare, creane uno! Per creare un nuovo account devi fornire i seguenti dati:
          <strong>nome, cognome, tipo di utente, email, password</strong>.
          <a href="signUp.php">Vai alla pagina di  <span lang="en">Sign up</span></a>.
        </p>
      </div>
      <div id="form" class="contentElement">
      	<form action="../operationManagers/logInOperationManager.php" method="POST">
      	<fieldset>
        	<legend>Form di accesso:</legend>

        	<p><span class="err"><?php
          if(isset($_SESSION["ErrLogin"])){
          echo $_SESSION["ErrLogin"]."</br>";
          unset($_SESSION["ErrLogin"]);
          } ?></span></p>

          <div id="email">
          <label for="Email">Email: </label>
        	<input type="email" id="Email" name="email" placeholder="mickey.mouse@gmail.com" value="<?php $datiInseriti=array(); 
          if(isset($_SESSION["datiInseriti"])){
          $datiInseriti=unserialize($_SESSION["datiInseriti"]);
          echo $datiInseriti[0]."";
          }?>" required><span class="err">
          <?php if(isset($_SESSION["ErrEm"])){
          echo $_SESSION["ErrEm"];
          unset($_SESSION["ErrEm"]);
          } ?></span>
          </div>

          <div id="password">
          <label for="Password">Password: </label>
        	<input type="password" id="Password" name="password" placeholder="inserisci la tua password" value="<?php if(isset($_SESSION["datiInseriti"])){
          echo $datiInseriti[1]."";
          unset($_SESSION["datiInseriti"]);
          }?>" required ><span class="err">
          <?php if(isset($_SESSION["ErrPassw"])){
          echo $_SESSION["ErrPassw"];
          unset($_SESSION["ErrPassw"]);
          } ?></span>
          </div>
        	<button type="submit" name = "login" >Accedi</button>
      	</fieldset>
      	</form>
    	</div>
    </div>

		<?php
		  $h->createStatisticDiv();
      $h->printContatti();
      $h->printFooter();

    ?>

  </body>
</html>
