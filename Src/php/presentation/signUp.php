<!DOCTYPE HTML>
<html lang ="it">
  <?php
      require_once("CommonHtmlElement.php");
      require_once("../services/Factory.php");
      require_once("../models/User.php");
      require_once("../services/Manipulator.php");
      require_once("../services/DBmanager.php");
      $h = new CommonHtmlElement();
      $d = new DBmanager("localhost", "root", "", "i_tesori_di_squitty_mod");
      $d->connect();
      $f = new Factory($d);
      $h->printHead("singUp", "area personale", "login, signup");
 ?>
 <body onload='creaStatistiche()'>
   <?php
	   session_start();
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
	   $h->createheader("signUp");
     $h->printInternalMenu("signUp");
   ?>

   <div id="content">
     <div id="info" class="contentElement">
    		<h3>INFO</h3>
			  <p>
        Se disponi gi&agrave di un account prego procedere all'accesso dal seguente bottone.
        </br>
			  <a href="logIn.php">Vai alla pagina di <span lang="en">Log in</span></a>.
        </p>
    </div>
	  <div class="contentElement">
				<form id="form" action="../operationManagers/signUpOperationManager.php"  method="POST">
					<fieldset>
            <legend>Creazione account:</legend>
            <p><span class="err"><?php
            if(isset($_SESSION["ErrSignup"])){
            echo $_SESSION["ErrSignup"]."</br>";
            unset($_SESSION["ErrSignup"]);
            } ?></span></p>

            <div id="nome">
  						<label for="Nome">Nome: </label>
  						<input type="text" name="nome" id="Nome" placeholder="insert your name"  value="<?php $datiInseriti=array();
              if(isset($_SESSION["datiIn"])){
              $datiInseriti=unserialize($_SESSION["datiIn"]);
              echo $datiInseriti[0]."";
              }?>" required><span class="err">
              <?php
              if(isset($_SESSION["ErrNome"])){
              echo $_SESSION["ErrNome"]."</br>";
              unset($_SESSION["ErrNome"]);
              } ?></span>
              </div>

              <div id="cognome">
  						<label for="Cognome">Cognome: </label>
  						<input type="text" id="Cognome" name="cognome"  placeholder="insert your surname"  value="<?php if(isset($_SESSION["datiIn"])){
              echo $datiInseriti[1]."";
              }?>" required><span class="err">
              <?php
              if(isset($_SESSION["ErrCognome"])){
              echo $_SESSION["ErrCognome"]."</br>";
              unset($_SESSION["ErrCognome"]);
              } ?><span>
              </div>

              <div id="tipo">
  						<label for="tipoUtente">Tipo utente: </label>
  						<select name="tipoUtente" required>
  							<option value="">--</option>
  							<option value="Al minuto">Al minuto</option>
  							<option value="All ingrosso">All'ingrosso</option>
  							<option value="Servizio">Servizio</option>
  							<option value="Impiegato">Impiegato</option>
  							</select>
              </div>

              <div id="email">
  						<label for="Email">Email: </label>
  						<input type="email" id="Email" name="emailSignup" placeholder="mickey.mouse@gmail.com"  value="<?php if(isset($_SESSION["datiIn"])){
              echo $datiInseriti[3]."";
              }?>" required><span class="err">
              <?php
              if(isset($_SESSION["ErrEmail"])){
              echo $_SESSION["ErrEmail"]."</br>";
              unset($_SESSION["ErrEmail"]);
              } ?></span>
              </div>

              <div id="password">
  						<label for="Password">Password: </label>
  						<input type="password" id="Password" name="passwordSignup" placeholder="insert your password"  value="<?php if(isset($_SESSION["datiIn"])){
              echo $datiInseriti[4]."";
              unset($_SESSION["datiIn"]);
              }?>" required><span class="err">
              <?php
              if(isset($_SESSION["ErrPassword"])){
              echo $_SESSION["ErrPassword"]."</br>";
              unset($_SESSION["ErrPassword"]);
              } ?></span>
              </div>

						<button type="submit" name="createAccount">Create account</button>
					</fieldset>
				</form>
			</div>
    </div>

    <?php
	    $h->createStatisticDiv();
      $h->printContatti();
      $h->printFooter();
      $h->printMobileMenu("singUp");
      $d->disconnect();
    ?>

  </body>
</html>
