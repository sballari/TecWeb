<!DOCTYPE HTML>
<html lang ="it">
  <?php
      require_once("CommonHtmlElement.php");
      require_once("../services/DBmanager.php");
      require_once("../models/User.php");
      require_once("../services/Factory.php");
      $h = new CommonHtmlElement();
      $h->printHead("SignUp", "area personale", "login, signup");
  ?>
  <body onload='creaStatistiche()'>
    <?php
      $h->printMobileMenu("SignUp");
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
	    $h->createheader("signUp");
      $h->printInternalMenu("signUp");
      $d->disconnect();
    ?>
    <div id="content">
      <div id="info" class="contentElement">
      	<h2>INFO</h2>
        <p>Se disponi gi&agrave; di un account proccedere al seguente bottone.
          <a href="logIn.php">Vai alla pagina di  <span lang="en">Log in</span></a>.
        </p>
      </div>
      <div id="form" class="contentElement">
      	<form action="../operationManagers/signUpOperationManager.php" method="POST">
      	<fieldset>
        	<legend>Creazione account:</legend>

        	<p><span class="err"><?php
          if(isset($_SESSION["ErrSignup"])){
          echo $_SESSION["ErrSignup"];
          unset($_SESSION["ErrSignup"]);
          } ?></span></p>

          <div id="nome">
          <label for="Nome">Nome: </label>
        	<input type="text" id="Nome" name="nome" placeholder="inserisci il tuo nome" value="<?php $datiIn=array();
          if(isset($_SESSION["datiIn"])){
          $datiIn=unserialize($_SESSION["datiIn"]);
          echo $datiIn[0]."";
          }?>" required><span class="err">
          <?php if(isset($_SESSION["ErrNome"])){
          echo $_SESSION["ErrNome"];
          unset($_SESSION["ErrNome"]);
          } ?></span>
          </div>

          <div id="cognome">
          <label for="Cognome">Cognome: </label>
        	<input type="text" id="Cognome" name="cognome" placeholder="inserisci il tuo cognome" value="<?php if(isset($_SESSION["datiIn"])){
          echo $datiIn[1]."";
          }?>" required ><span class="err">
          <?php if(isset($_SESSION["ErrCognome"])){
          echo $_SESSION["ErrCognome"];
          unset($_SESSION["ErrCognome"]);
          } ?></span>
          </div>
          

          <div id="tipo">
            <label for="tipoUtente">Tipo utente</label>
            <select id="tipoUtente" name="tipoUtente" required>
              <option value="">--</option>
              <option value="Al minuto">Al minuto</option>
              <option value="All_ingrosso">All'ingrosso</option>
              <option value="Servizio">Servizio</option>
              <option value="Impiegato">Impiegato</option>
            </select>
          </div>

          <div id="email">
          <label for="Email">Email: </label>
        	<input type="email" id="Email" name="emailSignup" placeholder="mickey.mouse@gmail.com" value="<?php
          if(isset($_SESSION["datiIn"])){
          echo $datiIn[3]."";
          }?>" required><span class="err">
          <?php if(isset($_SESSION["ErrEmail"])){
          echo $_SESSION["ErrEmail"];
          unset($_SESSION["ErrEmail"]);
          } ?></span>
          </div>

          <div id="password">
          <label for="Password">Password: </label>
        	<input type="password" id="Password" name="passwordSignup" placeholder="inserisci una password" value="<?php if(isset($_SESSION["datiIn"])){
          echo $datiIn[4]."";
          unset($_SESSION["datiIn"]);
          }?>" required ><span class="err">
          <?php if(isset($_SESSION["ErrPassword"])){
          echo $_SESSION["ErrPassword"];
          unset($_SESSION["ErrPassword"]);
          } ?></span>
          </div>
        	<button type="submit" name = "createAccount" >Crea Account</button>
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
